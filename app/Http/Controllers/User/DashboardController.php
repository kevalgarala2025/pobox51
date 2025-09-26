<?php

namespace App\Http\Controllers\User;

class DashboardController extends BaseController
{
    public $page_name = 'User Login';
    public $view_folder = VIEW_FOLDER_USER;

    /*
        @Description: Function for User Deshboard Page
        @Author: Sandeep Gajera
        @Input:
        @Output: - User Data
        @Date: 06-07-2023
    */
    public function index()
    {
        \Auth::guard(GUARD_USER)->user();
        // $event_detail =  UserEvents::where('i_user_id','=',$user_detail->id)->where('e_is_remove_data','No')->orderBy('id','asc')->first();
        // if(!empty($event_detail))
        // {
        //     if($event_detail->e_status == UserEvents::STATUS_ACTIVE)
        //     {
        //         return redirect()->route(ALIAS_USER.'event-email-start-sharing');
        //     }
        // }
        $view_folder = $this->view_folder;
        $page_name = $this->page_name;
        return view($this->view_folder.'.index', compact('page_name', 'view_folder'));
    }
}
