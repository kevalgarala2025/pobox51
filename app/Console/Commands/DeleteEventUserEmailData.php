<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\MailSendHelper;
use App\Models\CronJobs;
use App\Models\CronJobsLogs;
use App\Models\EmailTemplates;
use App\Models\UserEventParticipants;
use App\Models\UserEvents;
use Illuminate\Support\Facades\Storage;
use Rogersxd\VCard\VCard;

class DeleteEventUserEmailData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:delete-user-email-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (CronJobs::where('id', 2)->where('e_status', 'Active')->count()) {
            $CronOutputDescription = '<b>Cron Start<b><br>';

            $SendMailTime = getSettings('event_initial_timer_in_seconds');

            $UserEventFetchDateTime = date(CURRENT_DATE_TIME_FORMAT, time() - $SendMailTime);

            $UserEvents = UserEvents::where('e_status', '=', UserEvents::STATUS_COMPLETED)->where('created_at', '<=', $UserEventFetchDateTime)->where('e_is_remove_data', 'No')->withCount(['user_event_participants as i_tota_user_event_participant'])->get();
            $CronOutputDescription .= '<b>Total User Event Found : ' . $UserEvents->count() . '<b><br>';

            foreach ($UserEvents as $UserEvent) {
                if (! empty($UserEvent->d_event_sharing_completed_datetime)) {
                    $TimeFirst = strtotime($UserEvent->d_event_sharing_completed_datetime);
                    $TimeSecond = time();
                    $TimeDiffrenceInSeconds = abs($TimeFirst - $TimeSecond);

                    if ($TimeDiffrenceInSeconds > 15) {
                        $CronOutputDescription .= '<b>User Event ' . $UserEvent->v_email . ' Process Start<b><br>';

                        if (! empty($UserEvent->user)) {
                            $UserDetail = $UserEvent->user;
                            if (! empty($UserDetail)) {
                                $EventEmail = isset($UserEvent->v_email) && ($UserEvent->v_email !== '') ? $UserEvent->v_email . ' ' : 'Event-Email';

                                if (getSettings('event_max_number_of_participant') > 0) {
                                    $UserEventParticipants = UserEventParticipants::where('i_user_event_id', '=', $UserEvent->id)->orderBy('id', 'asc')->get()->take(getSettings('event_max_number_of_participant'));
                                } else {
                                    $UserEventParticipants = UserEventParticipants::where('i_user_event_id', '=', $UserEvent->id)->orderBy('id', 'asc')->get();
                                }

                                $CronOutputDescription .= '<b>User Event ' . $UserEvent->v_email . ' Total Participant Found ' . $UserEvent->i_tota_user_event_participant . '<b><br>';

                                if ($UserEvent->i_tota_user_event_participant > 0) {
                                    $VCFFileName = $UserEvent->v_email . '.vcf';
                                    $CSVFileName = $UserEvent->v_email . '.csv';

                                    //DELETE IF FILES EXISTS
                                    if (file_exists(CSV_FILE_PATH . $CSVFileName)) {
                                        unlink(CSV_FILE_PATH . $CSVFileName);
                                    }

                                    if (file_exists(NON_MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName)) {
                                        unlink(NON_MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName);
                                    }

                                    if (file_exists(MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName)) {
                                        unlink(MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName);
                                    }

                                    $EventDateTime = 'DATE-TIME:' . date(CURRENT_DATE_TIME_FORMAT, strtotime($UserEvent->created_at));
                                    $EventName = 'EVENT-NAME:' . $EventEmail;

                                    foreach ($UserEventParticipants as $UserEventParticipant) {
                                        $NoneMobileNumberVCard = new VCard();

                                        $NoneMobileNumberVCard->addnames(
                                            $UserEventParticipant->v_name
                                        );

                                        $Email = $UserEventParticipant->v_email;
                                        $NotesData = 'ORGANISER-NAME: ' . $UserEventParticipant->v_name . ' ' . $EventName . ' ' . $EventDateTime;

                                        $NoneMobileNumberVCard->addNote($NotesData);
                                        $NoneMobileNumberVCard->addEmail($Email);

                                        $NoneMobileNumberVCard->setFilename($UserEvent->v_email);
                                        $NoneMobileNumberVCard->setSavePath(NON_MOBILE_NUMBER_VCF_FILE_PATH);
                                        $NoneMobileNumberVCard->save();
                                    }

                                    //CSV TITLE COLUMNS
                                    $CSVColumns = ['ID', 'Name', 'Phone No', 'Email', 'Created At', 'Email Preview'];
                                    $CSVFile = fopen(CSV_FILE_PATH . $UserEvent->v_email . '.csv', 'w');
                                    fputcsv($CSVFile, $CSVColumns);

                                    $I = 1;
                                    foreach ($UserEventParticipants as $UserEventParticipant) {
                                        $CSVUserEventParticipant = [];
                                        $MobileNumberVCard = new VCard();

                                        $MobileNumberVCard->addnames(
                                            $UserEventParticipant->v_name
                                        );

                                        $PhoneNumber = '';
                                        if (isset($UserEventParticipant->v_phone_number) && $UserEventParticipant->v_phone_number !== '') {
                                            $PhoneNumber = $UserEventParticipant->v_phone_number;
                                        }
                                        $Email = $UserEventParticipant->v_email;
                                        $NotesData = 'ORGANISER-NAME: ' . $UserEventParticipant->v_name . ' ' . $EventName . ' ' . $EventDateTime;

                                        $MobileNumberVCard->addPhone($PhoneNumber, 'CELL');
                                        $MobileNumberVCard->addNote($NotesData);
                                        $MobileNumberVCard->addEmail($Email);
                                        $MobileNumberVCard->setFilename($UserEvent->v_email);
                                        $MobileNumberVCard->setSavePath(MOBILE_NUMBER_VCF_FILE_PATH);
                                        $MobileNumberVCard->save();

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

                                    $CronOutputDescription .= '<b>User Event ' . $UserEvent->v_email . ' VCF Generated<b><br>';

                                    fclose($CSVFile);

                                    $CronOutputDescription .= '<b>User Event ' . $UserEvent->v_email . ' CSV Generated<b><br>';

                                    $MobileNumberVCFFilePath = env('APP_URL') . MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName;
                                    $NonMobileNumberVCFFilePath = env('APP_URL') . NON_MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName;
                                    $CSVFilePath = env('APP_URL') . CSV_FILE_PATH . $CSVFileName;

                                    foreach ($UserEventParticipants as $UserEventParticipant) {
                                        $VCFFilePath = $NonMobileNumberVCFFilePath;
                                        if ($UserEventParticipant->v_phone_number !== '') {
                                            $VCFFilePath = $MobileNumberVCFFilePath;
                                        }

                                        $EmailTemplate = EmailTemplates::find(2);
                                        if (! empty($EmailTemplate)) {
                                            $ToArray = ['[EVENT_NAME]'];
                                            $ReplaceArray = [$UserEvent->v_email];
                                            $EmailTemplate->v_subject = str_replace($ToArray, $ReplaceArray, $EmailTemplate->v_subject);

                                            // MODIFT TEMPLATE
                                            $ToArray = ['[GUEST_NAME]', '[EVENT_NAME]', '[ORGANIZER_NAME_AND_EMAIL_ADDRESS]'];
                                            $ReplaceArray = [$UserEventParticipant->v_name, $UserEvent->v_email, $UserEvent->v_email . '@' . getSettings('event_email_domain_name')];
                                            $EmailTemplate->v_template_body = str_replace($ToArray, $ReplaceArray, $EmailTemplate->v_template_body);

                                            $Attachment = [
                                                'attachment' => $VCFFilePath,
                                                'as' => $UserEvent->v_email . '.vcf',
                                                'mime' => 'text/x-vcard',
                                                //'mime' => 'text/plain'
                                            ];

                                            try {
                                                // SEND EMAIL
                                                MailSendHelper::send_email($UserEventParticipant->id, '', $EmailTemplate, [$UserEventParticipant->v_email], [$Attachment]);
                                            } catch (\Exception $e) {
                                                $CronOutputDescription .= '<b>Event Participant Email Send Error ' . $e->getMessage() . '<br>';
                                            }
                                        }
                                    }

                                    if ($UserDetail->v_email !== '') {
                                        $EmailTemplate = EmailTemplates::find(3);
                                        if (! empty($EmailTemplate)) {
                                            // MODIFT TEMPLATE
                                            $ToArray = ['[NAME]', '[EVENT_EMAIL]', '[TOTAL_PARTICIPANTS]'];
                                            $ReplaceArray = [$UserDetail->v_full_name, $UserEvent->v_email, $UserEvent->i_tota_user_event_participant];
                                            $EmailTemplate->v_template_body = str_replace($ToArray, $ReplaceArray, $EmailTemplate->v_template_body);

                                            $Attachment = [
                                                'attachment' => $CSVFilePath,
                                                'as' => $UserEvent->v_email . '.csv',
                                                'mime' => 'text/csv',
                                                //'mime' => 'text/plain'
                                            ];

                                            try {
                                                // SEND EMAIL
                                                MailSendHelper::send_email($UserEvent->id, '', $EmailTemplate, [$UserDetail->v_email], [$Attachment]);
                                            } catch (\Exception $e) {
                                                $CronOutputDescription .= '<b>Organiser Email Send Error ' . $e->getMessage() . '<br>';
                                            }
                                        }
                                    }

                                    if (file_exists(NON_MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName)) {
                                        unlink(NON_MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName);
                                    }

                                    if (file_exists(MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName)) {
                                        unlink(MOBILE_NUMBER_VCF_FILE_PATH . $VCFFileName);
                                    }
                                } else {
                                    $CronOutputDescription .= '<b>Total Event Participant Found Else Condition : ' . $UserEvent->i_tota_user_event_participant . '<b><br>';
                                }

                                UserEventParticipants::where('i_user_event_id', '=', $UserEvent->id)->delete();
                                UserEvents::where('id', '=', $UserEvent->id)->update(['e_status' => UserEvents::STATUS_COMPLETED, 'e_is_remove_data' => 'Yes', 'i_total_participant' => $UserEvent->i_tota_user_event_participant]);
                            }
                        }

                        $CronOutputDescription .= '<b>User Event ' . $UserEvent->v_email . ' Process End<b><br>';
                    } else {
                        $CronOutputDescription .= '<b>TIme Diffrent Less Then 15 : ' . $TimeDiffrenceInSeconds . '<b><br>';
                    }
                }
            }

            $CronJobsLogs = new CronJobsLogs();

            $CronJobsLogs->i_cron_job_id = 2;

            $CronJobsLogs->v_cron_name = TITLE_CRON_FOR_EVENT_USER_EMAIL_DATA_DELETE;

            $CronJobsLogs->t_cron_description = MSG_CRON_FOR_EVENT_USER_EMAIL_DATA_DELETE;

            $CronJobsLogs->t_output_description = $CronOutputDescription;

            $CronJobsLogs->save();
        }
    }
}
