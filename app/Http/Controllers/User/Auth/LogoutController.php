<?php

namespace App\Http\Controllers\User\Auth;

class LogoutController extends BaseController
{
    /*
        @Description: Function for Log out
        @Author: Sandeep Gajera
        @Input:
        @Output: - Logout, Auth Delete
        @Date: 06-07-2023
    */
    public function index()
    {
        \Auth::guard(GUARD_USER)->logout();
        return redirect()->route(ALIAS_USER.'index');
    }
}
