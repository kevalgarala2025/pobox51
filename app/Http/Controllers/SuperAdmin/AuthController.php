<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.auth';

    /*
        @Description: Function for Profile
        @Author: Sandeep Gajera
        @Input: Fill All Form Data
        @Output: - Add user data in database
        @Date: 04-07-2023
    */
    public function profile(Request $request)
    {
        $User = \Auth::guard(GUARD_SUPERADMIN)->user();
        $PageName = 'Profile';
        if ($request->method() === 'POST') {
            $request->validate(
                [
                    'v_name' => 'required',
                    'v_email_id' => 'required|unique:super_admin,v_email_id,' . $User->id,
                    'v_mobile_number' => 'required|unique:super_admin,v_mobile_number,' . $User->id,
                ],
                [
                    'v_name.required' => 'Name is required',
                    'v_email_id.required' => 'Email is required',
                    'v_email_id.unique' => 'Email already exist.',
                    'v_mobile_number.required' => 'Mobile number is required',
                    'v_mobile_number.unique' => 'Mobile number already exist.',
                ]
            );

            if ($request->hasFile('v_profile_image')) {
                $file_name = imageUpload($request->file('v_profile_image'), ADMIN_PROFILE_PIC_IMG_PATH);
                $User->v_profile_image = $file_name;
            }
            $User->v_name = $request->v_name;
            $User->v_email_id = $request->v_email_id;
            $User->v_mobile_number = $request->v_mobile_number;
            $User->save();
            \Alert::success(TITLE_RECORD_UPDATED, MSG_RECORD_UPDATED);
            return redirect()->route('dashboard');
        }
        return view($this->ViewFolder.'.profile', compact('User', 'PageName'));
    }

    /*
        @Description: Function for Change PAssword
        @Author: Sandeep Gajera
        @Input: Password
        @Output: - Redirect change password Page
        @Date: 04-07-2023
    */
    public function changepassword(Request $request)
    {
        $User = \Auth::guard(GUARD_SUPERADMIN)->user();
        $PageName = 'Change Password';
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
            \Alert::success(TITLE_RECORD_UPDATED, MSG_PASSWORD_UPDATED);
            return redirect()->route('dashboard');
        }
        return view($this->ViewFolder.'.change-password', compact('User', 'PageName'));
    }
}
