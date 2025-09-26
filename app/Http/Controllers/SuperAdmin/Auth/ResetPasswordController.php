<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Models\SuperAdmin;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends BaseController
{
    use ResetsPasswords;
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    public $PageName = 'Reset Password';
    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'auth';

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/'.PREFIX_SUPERADMIN.'/login';

    /*
        @Description: Function for Reset Password Form
        @Author: Sandeep Gajera
        @Input: Foegot Password Token
        @Output: - Redirect Reset Password Form
        @Date: 03-07-2023
    */
    public function reset_password_form(Request $request, $token)
    {
        $User = SuperAdmin::where('v_forgot_password_code', $token)->first();
        if (! empty($User)) {
            $PageName = $this->PageName;
            return view($this->ViewFolder.'.passwords.reset', compact('PageName', 'User'));
        }

        \Alert::error(TITLE_RESET_PASSWORD_LINK_INVALID, MSG_RESET_PASSWORD_LINK_INVALID);
        return redirect()->route('login');
    }

    /*
        @Description: Function for Reset Password
        @Author: Sandeep Gajera
        @Input: Forgot Password code And New Password
        @Output: - Redirect Page With Msg
        @Date: 03-07-2023
    */
    public function reset_password(Request $request)
    {
        $User = SuperAdmin::where('v_forgot_password_code', $request->token)->first();
        if (! empty($User)) {
            if ($request->method() === 'POST') {
                $request->validate(
                    [
                        'password' => 'nullable|string|confirmed',
                    ],
                    [
                        'password.required' => 'Password is required',
                        'password.confirmed' => 'Password & confirmed password must be same',
                    ]
                );

                $User->password = \Hash::make($request->password);
                $User->save();
                \Alert::success(TITLE_RESET_PASSWORD_SUCCESS, MSG_RESET_PASSWORD_SUCCESS);
                return redirect()->route('login');
            }
        } else {
            \Alert::error(TITLE_RESET_PASSWORD_LINK_INVALID, MSG_RESET_PASSWORD_LINK_INVALID);
            return redirect()->route('login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
