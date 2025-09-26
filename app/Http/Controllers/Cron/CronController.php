<?php
namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Cron\Controller;

use Illuminate\Http\Request;

use Auth,DB;

use App\Models\{CronJobsLogs,CronJobs,UserEvents,Users,UserEventParticipants,EmailTemplates};

use App\Helpers\MailSendHelper;

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

use Rogersxd\VCard\VCard;

class CronController extends Controller
{
    //http://localhost/pivotdrive/contact-exchange-world/cron/event-user-email-data-read
    /*
        @Description: Function for Crow Job foe Mail
        @Author: Sandeep Gajera
        @Input:
        @Output: - Send Email For Read Messege
        @Date: 07-07-2023
    */
public function event_user_email_data_read()
{
        if(CronJobs::where('id',1)->where('e_status','Active')->count())
        {
            $UserEventEmails = [];

            $EventMaxNumberOfParticiPant = getSettings('event_max_number_of_participant');

            $ToalImapEmailFound  = 0;

            $CronOutputDescription = "<b>Cron Start<b><br>";

            $MailBox = "{".getSettings('imap_hostname').":".getSettings('imap_port_number')."/imap/ssl}INBOX";

            $IMAPConnection = imap_open($MailBox,env('IMAP_MAIL_USERNAME'),env('IMAP_MAIL_PASSWORD'));

            if($IMAPConnection)
            {
                $CronOutputDescription .= "<b>IMAP Connection Successfully<b><br>";

                $UserEventParticipants = [];

                $UnSeenEmails = imap_search($IMAPConnection,'UNSEEN');


                if($UnSeenEmails)
                {
                    $ToalImapEmailFound = count($UnSeenEmails);

                    rsort($UnSeenEmails);
                    $CronOutputDescription .= "<b>IMAP Connection Find Total UnSeen Email: ".count($UnSeenEmails)."<b><br>";
                    foreach($UnSeenEmails as $EmailNumber)
                    {
                        $EmailLogsContents = [];

                        $CronOutputDescription .= "<br><b>Start Process For Email Number : ".$EmailNumber."<b><br>**********************<br><br>";


                        $OverView   =  $EmailLogsContents['OverView']    = imap_fetch_overview($IMAPConnection,$EmailNumber,0);
                        $Message    =  $EmailLogsContents['Message']     = imap_fetchbody($IMAPConnection,$EmailNumber, 2);

                        $Header = imap_headerinfo($IMAPConnection, $EmailNumber);

                        $FromEmailAddress = $EmailLogsContents['FromEmailAddress'] = $Header->from[0]->mailbox . "@" . $Header->from[0]->host;
                        $ToEmailPrefix  = $EmailLogsContents['ToEmailPrefix'] = $Header->to[0]->mailbox;
                        $ToEmailAddress = $EmailLogsContents['ToEmailAddress'] =  $Header->to[0]->mailbox . "@" . $Header->to[0]->host;
                        $FromPersonName = "";
                        if(isset($Header->from[0]->personal))
                        {
                            $FromPersonName =  $EmailLogsContents['FromPersonName'] = $Header->from[0]->personal;
                        }


                        //VCF FILE ATTACHMENT READ CODE START
                        $Attachments = [];

                        $Structure = imap_fetchstructure($IMAPConnection, $EmailNumber);

                        if (isset($Structure->parts) && count($Structure->parts)) {
                            for ($i = 0; $i < count($Structure->parts); $i++) {
                                $Attachments = [];
                                $Part = $Structure->parts[$i];
                                if ($Part->ifdparameters) {
                                    foreach ($Part->dparameters as $Object) {
                                        if (strtolower($Object->attribute) == 'filename') {
                                            $FileName = $Object->value;
                                            if (strtolower(pathinfo($FileName, PATHINFO_EXTENSION)) === 'vcf') {
                                                $Attachments[$i]['is_attachment'] = true;
                                                $Attachments[$i]['filename'] = $FileName;
                                                $Attachments[$i]['attachment'] = imap_fetchbody($IMAPConnection, $EmailNumber, $i+1);

                                                // Decode attachment
                                                if ($Part->encoding == 3) { // Base64 encoding
                                                    $Attachments[$i]['attachment'] = base64_decode($Attachments[$i]['attachment']);
                                                } elseif ($Part->encoding == 4) { // Quoted-printable encoding
                                                    $Attachments[$i]['attachment'] = quoted_printable_decode($Attachments[$i]['attachment']);
                                                }

                                                // Define the path to store the file
                                                $Directory = 'files/vcf/user_email_attachments';

                                                // Ensure the directory exists (optional)
                                                if (!Storage::exists($Directory)) {
                                                    Storage::makeDirectory($Directory);
                                                }

                                                // Define the full path with filename
                                                $FilePath = $Directory . '/' . $FileName;

                                                // Save the attachment locally
                                                Storage::disk('public')->put($FilePath, $Attachments[$i]['attachment']);

                                                $Attachments[$i]['local_attachment_url'] = Storage::url($FilePath);

                                                $Attachments[$i]['local_attachment_url_unlink_path'] = $FilePath;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        $Contacts = [];
                        $Contact = [];
                        if(count($Attachments) == 1)
                        {
                            if(isset($Attachments[0]['local_attachment_url']) && $Attachments[0]['local_attachment_url'] != "")
                            {
                                $VCardData = file_get_contents($Attachments[0]['local_attachment_url']);
                                $Lines = explode("\n", $VCardData);
                                foreach ($Lines as $Line) {
                                    if (strpos($Line, 'BEGIN:VCARD') !== false) {
                                        $Contact = [];
                                    } elseif (strpos($Line, 'END:VCARD') !== false) {
                                        $Contacts[] = $Contact;
                                    } else {
                                        $Line = trim($Line);
                                        if (strpos($Line, 'FN:') === 0) {
                                            $Contact['name'] = substr($Line, 3);
                                        } elseif (strpos($Line, 'TEL:') === 0) {
                                            $Contact['phone'] = substr($Line, 4);
                                        } elseif (strpos($Line, 'EMAIL:') === 0) {
                                            $Contact['email'] = substr($Line, 6);
                                        }
                                    }
                                }
                            }
                        }
                        //VCF FILE ATTACHMENT READ CODE END

                        $UserPhoneNumber = $EmailOriginalSubject = $EmailSubject = "";
                        if(isset($OverView[0]->subject))
                        {
                            $EmailSubject =  $EmailLogsContents['EmailSubject'] = $EmailOriginalSubject   = utf8_encode($OverView[0]->subject);
                        }

                        $EmailDateTime  = $EmailLogsContents['EmailDateTime'] = date(CURRENT_DATE_TIME_FORMAT,strtotime($OverView[0]->date));
                        
                        if($EmailSubject != "" && count($Contacts) == 0)
                        {
                            //Find mobile
                            $FindMobile = '';
                            if(preg_match_all('/(\d[\s.]?)?[\(\[\s.]{0,2}?\d{3}[\)\]\s.]{0,2}?\d{3}[\s.]?\d{4}/',$EmailSubject,$MatchesData))
                            {
                                $EmailSubject = $MatchesData;
                            }
                            else if(preg_match_all('/(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}/',$EmailSubject,$MatchesData))
                            {
                                $EmailSubject = $MatchesData;
                            }
                            if(isset($EmailSubject[0][0]))
                            {
                                $FindMobile = $EmailSubject[0][0];
                            }
                            $UserPhoneNumber = $FindMobile?$FindMobile:'';
                            $EmailLogsContents['UserPhoneNumber'] = $UserPhoneNumber;
                        }
                        else
                        {
                            //WHEN ATTACH VCF WITH ONE CONTACT THEN IT TAKE FROM THAT PERSON NAME AND MOBILE AND EMAIL
                            if(count($Contacts) == 1)
                            {
                                $UserPhoneNumber = $Contacts[0]['phone'];
                                if(isset($Contacts[0]['name']) && $Contacts[0]['name'] != "")
                                {
                                    $FromPersonName  = $Contacts[0]['name'];
                                }
                                if(isset($Contacts[0]['email']) && $Contacts[0]['email'] != "")
                                {
                                    $FromEmailAddress  = $Contacts[0]['email'];
                                }
                            }
                        }

                        $UserEvents = UserEvents::where('v_email',$ToEmailPrefix)->where('e_is_remove_data','No')->withCount('user_event_participants')->orderBy('id','DESC')->get();

                        if(!empty($UserEvents))
                        {
                            $EmailLogsContents['IsFindEvent'] = "Yes";

                            $UserEventCounts = [];

                            foreach ($UserEvents as $Key => $UserEvent) {

                                if($UserEvent->e_status == UserEvents::STATUS_ACTIVE ||  ($UserEvent->e_status == UserEvents::STATUS_COMPLETED && strtotime($UserEvent->d_event_sharing_completed_datetime)   >=  strtotime($EmailDateTime) )  )
                                {
                                    if(UserEventParticipants::where('i_user_id',$UserEvent->i_user_id)->where('i_user_event_id',$UserEvent->id)->where('v_email',$FromEmailAddress)->count() == 0 && !in_array(trim($FromEmailAddress),$UserEventEmails) )
                                    {
                                        if(isset($UserEventCounts[$UserEvent->id]))
                                        {
                                            $UserEventCounts[$UserEvent->id] = $UserEventCounts[$UserEvent->id] + 1;
                                        }
                                        else
                                        {
                                            $UserEventCounts[$UserEvent->id] = $UserEvent->user_event_participants_count;
                                        }

                                        if($EventMaxNumberOfParticiPant > $UserEventCounts[$UserEvent->id])
                                        {
                                            $EmailLogsContents['IsAddRecordInTable'] = "Yes";
                                            $Message = trim(strip_tags($Message));
                                            if (empty($Message)) {
                                                $Message = 'No content available';
                                            } else {
                                                $Message = substr($Message, 0, 50);
                                            }
                                            $UserEventParticipants[] =
                                            [
                                                'i_user_id'         => $UserEvent->i_user_id,
                                                'i_user_event_id'   => $UserEvent->id,
                                                'v_name'            => $FromPersonName,
                                                'v_phone_number'    => trim($UserPhoneNumber),
                                                'v_email'           => trim($FromEmailAddress),
                                                't_email_subject'   => $EmailOriginalSubject,
                                                't_email_body'      => $Message,
                                                'd_email_datetime'  => $EmailDateTime,
                                                'created_at'        => CURRENT_DATE_TIME,
                                                'updated_at'        => CURRENT_DATE_TIME
                                            ];
                                            array_push($UserEventEmails,trim($FromEmailAddress));
                                        }
                                    }
                                }

                            }
                        }
                        else
                        {
                            $EmailLogsContents['IsFindEvent'] = "No";
                        }


                        if(count($EmailLogsContents))
                        {
                            $CronOutputDescription .= "<br><br>@@@@@@@@@@@@@@@@@@<br><b>".json_encode($EmailLogsContents)."<b><br>@@@@@@@@@@@@@@@@<br><br>";
                        }

                        $CronOutputDescription .= "<br>**********************<br><b>End Process For Email Number : ".$EmailNumber."<b><br><br><br>";

                        //DELETE VCF ATTACHMENT FILE FROM OUR SERVER START
                        if(count($Attachments))
                        {
                            foreach($Attachments as $KeyAttachment => $Attachment)
                            {
                                if (Storage::disk('public')->exists($Attachment['local_attachment_url_unlink_path'])) {
                                    Storage::disk('public')->delete($Attachment['local_attachment_url_unlink_path']);
                                }
                            }
                        }
                        //DELETE VCF ATTACHMENT FILE FROM OUR SERVER END
                    }

                    if(count($UserEventParticipants))
                    {
                        $CronOutputDescription .= "<b>User Event Participant Table Added Record Total : ".count($UserEventParticipants)."<b><br>";

                        UserEventParticipants::insert($UserEventParticipants);
                    }
                }
                else
                {
                    $CronOutputDescription .= "<b>IMAP Connection Not Found UnSeen Email<b><br>";
                }
            }
            else
            {
                $CronOutputDescription .= "<b>IMAP Connection Issue<b><br>";
            }



            $CronJobsLogs = new CronJobsLogs;

            $CronJobsLogs->i_cron_job_id        = 1;

            $CronJobsLogs->v_cron_name          = TITLE_CRON_FOR_EVENT_USER_EMAIL_DATA_READ;

            $CronJobsLogs->t_cron_description   = MSG_CRON_FOR_EVENT_USER_EMAIL_DATA_READ;

            $CronJobsLogs->t_output_description = $CronOutputDescription;

            $CronJobsLogs->i_imap_email_found = $ToalImapEmailFound;

            $CronJobsLogs->save();
        }

    }

    //http://localhost/pivotdrive/contact-exchange-world/cron/event-user-email-data-delete
    /*
        @Description: Function for Crow Job For User Event Data Delete
        @Author: Sandeep Gajera
        @Input:
        @Output: - Delete User Event Mail
        @Date: 09-07-2023
    */
    public function event_user_email_data_delete()
    {
        if(CronJobs::where('id',2)->where('e_status','Active')->count())
        {
            $CronOutputDescription = "<b>Cron Start<b><br>";

            $SendMailTime = getSettings('event_initial_timer_in_seconds');

            $UserEventFetchDateTime = date(CURRENT_DATE_TIME_FORMAT, time() - $SendMailTime);

            $UserEvents = UserEvents::where('e_status','=',UserEvents::STATUS_COMPLETED)->where('created_at','<=',$UserEventFetchDateTime)->where('e_is_remove_data','No')->withCount(['user_event_participants as i_tota_user_event_participant'])->get();

            $CronOutputDescription .= "<b>Total User Event Found : ".$UserEvents->count()."<b><br>";

            foreach($UserEvents as $UserEvent)
            {
                if(!empty($UserEvent->d_event_sharing_completed_datetime))
                {
                    $TimeFirst  = strtotime($UserEvent->d_event_sharing_completed_datetime);
                    $TimeSecond = time();
                    $TimeDiffrenceInSeconds = abs($TimeFirst - $TimeSecond);

                    if($TimeDiffrenceInSeconds > 15)
                    {
                        $CronOutputDescription .= "<b>User Event ".$UserEvent->v_email." Process Start<b><br>";

                        if(!empty($UserEvent->user))
                        {
                            $UserDetail = $UserEvent->user;
                            if(!empty($UserDetail))
                            {
                                $EventEmail                    = (isset($UserEvent->v_email) && ($UserEvent->v_email != "") )?$UserEvent->v_email." ":"Event-Email";

                                if(getSettings('event_max_number_of_participant') > 0)
                                {
                                    $UserEventParticipants            = UserEventParticipants::where('i_user_event_id','=',$UserEvent->id)->orderBy('id','asc')->get()->take(getSettings('event_max_number_of_participant'));
                                }
                                else
                                {
                                    $UserEventParticipants            = UserEventParticipants::where('i_user_event_id','=',$UserEvent->id)->orderBy('id','asc')->get();
                                }

                                // Filter for unique email participants only
                                $UniqueEmailParticipants = $UserEventParticipants->unique('v_email');
                                
                                $CronOutputDescription .= "<b>User Event ".$UserEvent->v_email." Total Participant Found ".$UserEvent->i_tota_user_event_participant." (Unique Emails: ".$UniqueEmailParticipants->count().")<b><br>";

                                if($UserEvent->i_tota_user_event_participant > 0)
                                {

                                    $VCFFileName = $UserEvent->v_email.".vcf";
                                    $CSVFileName = $UserEvent->v_email.".csv";

                                    //DELETE IF FILES EXISTS
                                    if(file_exists(CSV_FILE_PATH.$CSVFileName))
                                    {
                                        unlink(CSV_FILE_PATH.$CSVFileName);
                                    }

                                    // Clean up any existing combined VCF files
                                    if(file_exists(NON_MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName))
                                    {
                                        unlink(NON_MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName);
                                    }

                                    if(file_exists(MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName))
                                    {
                                        unlink(MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName);
                                    }

                                    $EventDateTime          = 'DATE-TIME' . ':' .date(CURRENT_DATE_TIME_FORMAT,strtotime($UserEvent->created_at));
                                    $EventName              = 'EVENT-NAME' . ': ' . $EventEmail;
                                    
                                    // Create combined VCard content for unique email participants
                                    $CombinedVCardContent = '';
                                    
                                    foreach($UniqueEmailParticipants as $Key => $UserEventParticipant)
                                    {
                                        $NoneMobileNumberVCard  = new VCard();

                                        $NoneMobileNumberVCard->addnames
                                        (
                                            $UserEventParticipant->v_name
                                        );

                                        $Email                  = $UserEventParticipant->v_email;
                                        $NotesData              = 'ORGANISER-NAME' . ': ' .$UserEventParticipant->v_name.' '.$EventName.' '.$EventDateTime;

                                        $NoneMobileNumberVCard->addNote($NotesData);
                                        $NoneMobileNumberVCard->addEmail($Email);

                                        // Save to temporary file and read its content
                                        $TempFileName = 'temp_' . $UserEventParticipant->id . '_' . time() . '_' . rand(1000, 9999);
                                        $NoneMobileNumberVCard->setFilename($TempFileName);
                                        $NoneMobileNumberVCard->setSavePath(NON_MOBILE_NUMBER_VCF_FILE_PATH);
                                        $NoneMobileNumberVCard->save();
                                        
                                        // Read the temporary file content
                                        $TempFilePath = NON_MOBILE_NUMBER_VCF_FILE_PATH . $TempFileName . '.vcf';
                                        if (file_exists($TempFilePath)) {
                                            $CombinedVCardContent .= file_get_contents($TempFilePath);
                                            // Delete the temporary file
                                            unlink($TempFilePath);
                                        }
                                    }
                                    
                                    // Save all contacts to one combined VCard file
                                    if (!empty($CombinedVCardContent)) {
                                        $FinalVCardPath = NON_MOBILE_NUMBER_VCF_FILE_PATH . $UserEvent->v_email . '.vcf';
                                        file_put_contents($FinalVCardPath, $CombinedVCardContent);
                                    }
                                    //CSV TITLE COLUMNS
                                    $CSVColumns = ['ID','Name','Phone No','Email','Created At','Email Preview'];
                                    $CSVFile    = fopen(CSV_FILE_PATH . $UserEvent->v_email.'.csv', 'w');
                                    fputcsv($CSVFile,$CSVColumns);


                                    // Create combined Mobile VCard content for unique email participants
                                    $CombinedMobileVCardContent = '';
                                    
                                    $I=1;
                                    foreach($UniqueEmailParticipants as $Key => $UserEventParticipant)
                                    {
                                        $CSVUserEventParticipant = [];
                                        $MobileNumberVCard = new VCard();

                                        $MobileNumberVCard->addnames
                                        (
                                            $UserEventParticipant->v_name
                                        );

                                        $PhoneNumber = "";
                                        if(isset($UserEventParticipant->v_phone_number) && $UserEventParticipant->v_phone_number != "")
                                        {
                                            $PhoneNumber            = $UserEventParticipant->v_phone_number;
                                        }
                                        $Email                  = $UserEventParticipant->v_email;
                                        $NotesData              = 'ORGANISER-NAME' . ': ' .$UserEventParticipant->v_name.' '.$EventName.' '.$EventDateTime;

                                        $MobileNumberVCard->addPhone($PhoneNumber, 'CELL');
                                        $MobileNumberVCard->addNote($NotesData);
                                        $MobileNumberVCard->addEmail($Email);
                                        
                                        // Save to temporary file and read its content
                                        $TempMobileFileName = 'temp_mobile_' . $UserEventParticipant->id . '_' . time() . '_' . rand(1000, 9999);
                                        $MobileNumberVCard->setFilename($TempMobileFileName);
                                        $MobileNumberVCard->setSavePath(MOBILE_NUMBER_VCF_FILE_PATH);
                                        $MobileNumberVCard->save();
                                        
                                        // Read the temporary file content
                                        $TempMobileFilePath = MOBILE_NUMBER_VCF_FILE_PATH . $TempMobileFileName . '.vcf';
                                        if (file_exists($TempMobileFilePath)) {
                                            $CombinedMobileVCardContent .= file_get_contents($TempMobileFilePath);
                                            // Delete the temporary file
                                            unlink($TempMobileFilePath);
                                        }

                                        //CSV ARRAY
                                        $CSVUserEventParticipant[] = $I;
                                        $CSVUserEventParticipant[] = $UserEventParticipant->v_name;
                                        $CSVUserEventParticipant[] = $PhoneNumber;
                                        $CSVUserEventParticipant[] = $Email;
                                        $CSVUserEventParticipant[] = $UserEventParticipant->created_at;
                                        //$CSVUserEventParticipant[] = substr($UserEventParticipant->t_email_body,0,100);
                                        //$CSVUserEventParticipant[] = strip_tags($UserEventParticipant->t_email_body);

                                        $CSVUserEventParticipant[] = $UserEventParticipant->t_email_body;


                                        //STORE DATA IN CSV
                                        fputcsv($CSVFile, $CSVUserEventParticipant);

                                        $I++;
                                    }

                                    // Save all contacts to one combined Mobile VCard file
                                    if (!empty($CombinedMobileVCardContent)) {
                                        $FinalMobileVCardPath = MOBILE_NUMBER_VCF_FILE_PATH . $UserEvent->v_email . '.vcf';
                                        file_put_contents($FinalMobileVCardPath, $CombinedMobileVCardContent);
                                    }

                                    $CronOutputDescription .= "<b>User Event ".$UserEvent->v_email." VCF Generated<b><br>";

                                    fclose($CSVFile);

                                    $CronOutputDescription .= "<b>User Event ".$UserEvent->v_email." CSV Generated<b><br>";

                                    $MobileNumberVCFFilePath = env('APP_URL').MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName;
                                    $NonMobileNumberVCFFilePath = env('APP_URL').NON_MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName;
                                    $CSVFilePath = env('APP_URL').CSV_FILE_PATH.$CSVFileName;

                                    foreach($UniqueEmailParticipants as $UserEventParticipant)
                                    {
                                        $VCFFilePath = $NonMobileNumberVCFFilePath;
                                        if($UserEventParticipant->v_phone_number != "")
                                        {
                                            $VCFFilePath = $MobileNumberVCFFilePath;
                                        }

                                        $EmailTemplate = EmailTemplates::find(2);
                                        if(!empty($EmailTemplate))
                                        {

                                            $ToArray                        = array('[EVENT_NAME]');
                                            $ReplaceArray                   = array($UserEvent->v_email);
                                            $EmailTemplate->v_subject       = str_replace($ToArray,$ReplaceArray,$EmailTemplate->v_subject);


                                            // MODIFT TEMPLATE
                                            $ToArray            = array('[GUEST_NAME]','[EVENT_NAME]','[ORGANIZER_NAME_AND_EMAIL_ADDRESS]');
                                            $ReplaceArray      = array($UserEventParticipant->v_name,$UserEvent->v_email,$UserEvent->v_email.'@'.getSettings('event_email_domain_name'));
                                            $EmailTemplate->v_template_body =  str_replace($ToArray,$ReplaceArray,$EmailTemplate->v_template_body);

                                            $Attachment = [
                                                'attachment'    => $VCFFilePath,
                                                'as'            => $UserEvent->v_email.'.vcf',
                                                'mime'          => 'text/x-vcard',
                                                //'mime' => 'text/plain'
                                            ];

                                            try
                                            {
                                                // SEND EMAIL
                                                MailSendHelper::send_email($UserEventParticipant->id,'',$EmailTemplate,[$UserEventParticipant->v_email],[$Attachment]);
                                            }
                                            catch(\Exception $e)
                                            {
                                                $CronOutputDescription .= "<b>Event Participant Email Send Error ".$e->getMessage()."<br>";
                                            }
                                        }
                                    }


                                    if($UserDetail->v_email != "")
                                    {
                                        $EmailTemplate = EmailTemplates::find(3);
                                        if(!empty($EmailTemplate))
                                        {
                                            // MODIFT TEMPLATE
                                            $ToArray                           = array('[NAME]','[EVENT_EMAIL]','[TOTAL_PARTICIPANTS]');
                                            $ReplaceArray                      = array($UserDetail->v_full_name,$UserEvent->v_email,$UniqueEmailParticipants->count());
                                            $EmailTemplate->v_template_body    = str_replace($ToArray,$ReplaceArray,$EmailTemplate->v_template_body);

                                            $Attachment = [
                                                'attachment'    => $CSVFilePath,
                                                'as'            => $UserEvent->v_email.'.csv',
                                                'mime'          => 'text/csv',
                                                //'mime' => 'text/plain'
                                            ];

                                            try
                                            {
                                                // SEND EMAIL
                                                MailSendHelper::send_email($UserEvent->id,'',$EmailTemplate,[$UserDetail->v_email],[$Attachment]);
                                            }
                                            catch(\Exception $e)
                                            {
                                                $CronOutputDescription .= "<b>Organiser Email Send Error ".$e->getMessage()."<br>";
                                            }
                                        }
                                    }

                                    // Clean up combined VCF files after email sending
                                    if(file_exists(NON_MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName))
                                    {
                                        unlink(NON_MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName);
                                    }

                                    if(file_exists(MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName))
                                    {
                                        unlink(MOBILE_NUMBER_VCF_FILE_PATH.$VCFFileName);
                                    }
                                }
                                else
                                {
                                    $CronOutputDescription .= "<b>Total Event Participant Found Else Condition : ".$UserEvent->i_tota_user_event_participant." (Unique Emails: ".$UniqueEmailParticipants->count().")<b><br>";
                                }

                                // UserEventParticipants::where('i_user_event_id','=',$UserEvent->id)->delete();
                                UserEvents::where('id','=',$UserEvent->id)->update(["e_status"=>UserEvents::STATUS_COMPLETED,'e_is_remove_data'=>'Yes','i_total_participant'=>$UniqueEmailParticipants->count()]);
                            }
                        }

                        $CronOutputDescription .= "<b>User Event ".$UserEvent->v_email." Process End<b><br>";
                    }
                    else
                    {
                        $CronOutputDescription .= "<b>TIme Diffrent Less Then 15 : ".$TimeDiffrenceInSeconds."<b><br>";
                    }
                }
            }


            $CronJobsLogs = new CronJobsLogs;

            $CronJobsLogs->i_cron_job_id        = 2;

            $CronJobsLogs->v_cron_name          = TITLE_CRON_FOR_EVENT_USER_EMAIL_DATA_DELETE;

            $CronJobsLogs->t_cron_description   = MSG_CRON_FOR_EVENT_USER_EMAIL_DATA_DELETE;

            $CronJobsLogs->t_output_description = $CronOutputDescription;

            $CronJobsLogs->save();
        }

    }

}
