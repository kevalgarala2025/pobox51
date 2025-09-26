<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    public $PageName = 'Login';
    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.auth';

    // public function __construct()
    // {

    //     $this->middleware('guest')->except('logout');
    // }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'.PREFIX_SUPERADMIN.'/dashboard';

    /*
        @Description: Function for Login Form
        @Author: Sandeep Gajera
        @Input: Current Page Name
        @Output: - Login View
        @Date: 03-07-2023
    */
    public function login_form()
    {
        $PageName = $this->PageName;
        return view($this->ViewFolder.'.login', compact('PageName'));
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    /*
       @Description: Function for Email
       @Author: Sandeep Gajera
       @Input:
       @Output: - Email
       @Date: 03-07-2023
    */
    public function username()
    {
        return 'v_email_id';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
