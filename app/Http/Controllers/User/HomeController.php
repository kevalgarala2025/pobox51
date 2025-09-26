<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    public $page_name = 'User Login';
    public $view_folder = VIEW_FOLDER_USER;

    /*
        @Description: Function for View Home Page
        @Author: Sandeep Gajera
        @Input: Request
        @Output: - Sent Current Page Name
        @Date: 08-07-2023
    */
    public function index()
    {
        //\Auth::guard(GUARD_USER)->loginUsingId(1);

        $view_folder = $this->view_folder;
        $page_name = $this->page_name;
        return view($this->view_folder.'.index', compact('page_name', 'view_folder'));
    }

    /*
        @Description: Function for Context
        @Author: Sandeep Gajera
        @Input: Request
        @Output: - Contet Page
        @Date: 08-07-2023
    */
    public function context()
    {
        $view_folder = $this->view_folder;
        $page_name = $this->page_name;
        return view($this->view_folder.'.context', compact('page_name', 'view_folder'));
    }
}
