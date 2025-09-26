<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\SuperAdmin;
use Illuminate\Http\Request;

class CommonController extends BaseController
{
    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.common';

    /*
        @Description: Function for Lockscreen
        @Author: Sandeep Gajera
        @Input: User Auth
        @Output: - Redirect
        @Date: 05-07-2023
    */
    public function lockscreen()
    {
        if (\Auth::guard(GUARD_SUPERADMIN)->check()) {
            $User = \Auth::guard(GUARD_SUPERADMIN)->user();
            \Auth::guard(GUARD_SUPERADMIN)->logout();
            $PageName = 'Lock Screen';
            return view($this->ViewFolder.'.lockscreen', compact('User', 'PageName'));
        }
        return redirect()->route('login');
    }

    /*
        @Description: Function for Lockscreen Login
        @Author: Sandeep Gajera
        @Input: Email, Password
        @Output: - Reditect and login
        @Date: 05-07-2023
    */
    public function lockscreen_login(Request $request)
    {
        if ($request->has('v_email_id') && $request->has('password')) {
            $request->validate(
                [
                    'password' => 'required',
                    'v_email_id' => 'required',
                ],
                [
                    'password.required' => 'Password is required',
                    'v_email_id.required' => 'Username is required',
                ]
            );

            $auth = auth()->guard(GUARD_SUPERADMIN)->attempt([
                'v_email_id' => e(trim($request->get('v_email_id'))),
                'password' => e(trim($request->get('password'))),
            ], true);

            if ($auth) {
                return redirect()->route('dashboard');
            }
            $PageName = 'Lock Screen';
            $User = SuperAdmin::where('v_email_id', $request->get('v_email_id'))->first();
            \Alert::error(TITLE_LOGIN_INVALID_PASSWORD, MSG_INVALID_PASSWORD);
            return view($this->ViewFolder.'.lockscreen', compact('User', 'PageName'));
        }
        return redirect()->route('login');
    }
}
