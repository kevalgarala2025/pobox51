<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Helpers\MailSendHelper;
use App\Models\EmailTemplates;
use App\Models\SuperAdmin;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.auth';
    public $PageName = 'Forgot Password';

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    /*
        @Description: Function for Forgot Password Form
        @Author: Sandeep Gajera
        @Input: Current Page Name
        @Output: - Return Email View
        @Date: 02-07-2023
    */
    public function forgot_password_form()
    {
        $PageName = $this->PageName;
        return view($this->ViewFolder.'.passwords.email', compact('PageName'));
    }

    /**
     * Get the needed authentication credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    /*
        @Description: Function for Credential
        @Author: Sandeep Gajera
        @Input:
        @Output: - Email
        @Date: 02-07-2023
    */
    protected function credentials(Request $request)
    {
        return $request->only('v_email_id');
    }

    /*
        @Description: Function for Forgot Password Email
        @Author: Sandeep Gajera
        @Input: User Email
        @Output: - Sent Email
        @Date: 02-07-2023
    */
    protected function forgot_password_email(Request $request)
    {
        $request->validate(
            [
                'v_email_id' => 'required|email|exists:superadmin,v_email_id',
            ],
            [
                'v_email_id.required' => 'Email is required.',
                'v_email_id.email' => 'Email is invalid.',
                'v_email_id.exists' => 'Email not registered in system.',
            ]
        );

        $User = SuperAdmin::where('v_email_id', $request->v_email_id)->first();

        $User->v_forgot_password_code = generateRandomString(10); // random access_code
        if ($User->save()) {
            $EmailTemplate = EmailTemplates::find(1);
            if (! empty($EmailTemplate)) {
                // MODIFT TEMPLATE
                $ToArray = ['[LINK]','[USERNAME]'];
                $ReplaceArray = [route('password.reset', ['token' => $User->v_forgot_password_code]),$User->v_name];
                $EmailTemplate->v_template_body = str_replace($ToArray, $ReplaceArray, $EmailTemplate->v_template_body);

                // SEND EMAIL
                MailSendHelper::send_email($User->id, $User->i_role_id, $EmailTemplate, [$request->v_email_id]);
                \Alert::success(TITLE_FORGOT_PASSWORD_SENT_EMAIL, MSG_FORGOT_PASSWORD_SENT_EMAIL);
                return redirect()->route('login');
            }

            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, MSG_SOMETHING_WENT_WRONG_AT_SERVER);
            return redirect()->route('password.request');
        }
    }
}
