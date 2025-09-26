<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\UserEvents;
use App\Models\Users;

class DashboardController extends BaseController
{
    public $Module = 'Dashboard';

    public $RecordModule = 'Dashboard';

    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.dashboard';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
        @Description: Function for Deshboard page
        @Author: Sandeep Gajera
        @Input:
        @Output: - Desboard data
        @Date: 05-07-2023
    */
    public function index()
    {
        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $Dashboard = $StasticsCount = $DashboardStastics = [];

        //START STASTICS
        $StasticsCount[1]['count'] = Users::count();

        $StasticsCount[1]['link'] = route('users.index');

        $StasticsCount[1]['icon'] = 'bx bx-user';

        $StasticsCount[1]['label'] = 'Users';

        $StasticsCount[2]['count'] = UserEvents::count();

        $StasticsCount[2]['link'] = route('user-events.index');

        $StasticsCount[2]['icon'] = 'bx bx-building-house';

        $StasticsCount[2]['label'] = 'User Events';

        if (count($StasticsCount)) {
            $Dashboard['stasticscount'] = $StasticsCount;
        }
        if (count($DashboardStastics)) {
            $Dashboard['dashboardstastics'] = $DashboardStastics;
        }

        return view($this->ViewFolder.'.index', compact('Module', 'RecordModule', 'Dashboard'));
    }
}
