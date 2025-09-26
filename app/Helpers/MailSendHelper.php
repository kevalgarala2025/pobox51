<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Mail;

class MailSendHelper
{
    public static function send_email($UserId = 0, $RoleId = 0, $EmailData = [], $ToSenderEmailids = [], $Attachments = [], $CcSenderEmailids = [], $BccSenderEmailids = [])
    {
        //Common Replace Value For All Email
        $ToArray = ['[SITE_URL]', '[SITE_NAME]', '[DATE]', '[IMG_LOGO_PATH]', '[MAIL_FOOTER_LINK]', '[MAIL_FOOTER_LINK_LABEL]', '[NAME_PREFIX]'];
        $ReplaceArray = [env('APP_URL'), env('APP_NAME'), '', \URL::asset('assets/images/logo.png'), EMAIL_FOOTER_LINK, EMAIL_FOOTER_LINK_LABEL, 'Hello '];

        $EmailData->v_template_body = str_replace($ToArray, $ReplaceArray, $EmailData->v_template_body);

        //Mail Send Code
        if (count($ToSenderEmailids) === 0) {
            $ToSenderEmailids = MailSendHelper::to_emails_send_list();
        }
        if (count($CcSenderEmailids) === 0) {
            $CcSenderEmailids = MailSendHelper::cc_emails_send_list();
        }
        if (count($BccSenderEmailids) === 0) {
            $BccSenderEmailids = MailSendHelper::bcc_emails_send_list();
        }

        if (count($ToSenderEmailids)) {
            /*echo view('emails.send',array_merge(array('email_body'=>$EmailData->v_template_body)));
            exit;*/

            //Laravel Method For Send Mail
            Mail::send('emails.send', $data = ['email_body' => $EmailData->v_template_body], function ($message) use ($EmailData, $ToSenderEmailids, $CcSenderEmailids, $BccSenderEmailids, $Attachments) {
                $message->subject($EmailData->v_subject);
                $message->from($EmailData->v_from_email_id, env('APP_NAME'));
                $message->to($ToSenderEmailids);
                $message->cc($CcSenderEmailids);
                $message->bcc($BccSenderEmailids);
                if (count($Attachments)) {
                    foreach ($Attachments as $Attachment) {
                        $message->attach(
                            $Attachment['attachment'],
                            [
                                'as' => $Attachment['as'],
                                'mime' => $Attachment['mime'],
                            ]
                        );
                    }
                }
            });
        }
        return '1';
        /*if(count(Mail::failures()) > 0) {
          //If Mail Not Send Sucessfully
          return '0';
        } else {
          //If Mail Send Sucessfully
          //Save Data In Logs Table

          if(!is_array($ToSenderEmailids)) {
            $EmailId = $ToSenderEmailids;
            $ToSenderEmailids = [];
            $ToSenderEmailids[]  = $EmailId;
          }
          if(count($ToSenderEmailids)) {
            foreach ($ToSenderEmailids as $key => $Email) {
              $UserEmailSentLog  = new MailSentLogs;
              $UserEmailSentLog->i_email_template_id = $EmailData->id;
              $UserEmailSentLog->v_email_subject  = $EmailData->v_subject;
              $UserEmailSentLog->t_email_content  = $EmailData->v_template_body;
              $UserEmailSentLog->v_email_id       = $Email;
              $UserEmailSentLog->i_user_id        = $UserId;
              $UserEmailSentLog->i_role_id        = $RoleId;
              $UserEmailSentLog->save();
            }
          }
          return '1';
        }*/
    }

    private static function to_emails_send_list()
    {
        return [];
    }

    private static function cc_emails_send_list()
    {
        return [];
    }

    private static function bcc_emails_send_list()
    {
        return [];
    }
}
