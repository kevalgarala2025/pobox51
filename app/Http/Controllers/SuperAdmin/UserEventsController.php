<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\UserEvents;
use App\Models\Users;
use Illuminate\Http\Request;

class UserEventsController extends BaseController
{
    public $Module = 'User Events';

    public $RecordModule = 'User Event';

    public $RecordShowModule = 'View User Event';

    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.user-events';

    public $RoutePrefixName = 'user-events';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for User Event Page
        @Author: Sandeep Gajera
        @Input:
        @Output: - All Event data
        @Date: 08-07-2023
    */
    public function index(Request $Request)
    {
        $query = new UserEvents();

        $query = $query->has('user');

        if ($Request->has('keyword') && $Request->get('keyword') !== '') {
            $query = $query->where('v_email', 'LIKE', '%'.$Request->get('keyword').'%')

                ->oRwhere('v_event_unique_id', 'LIKE', '%'.$Request->get('keyword').'%');
        }

        if ($Request->has('event_status') && $Request->get('event_status') !== '') {
            $query = $query->where('e_status', '=', $Request->get('event_status'));
        }

        if ($Request->has('user_id') && $Request->get('user_id') !== '') {
            $query = $query->where('i_user_id', '=', $Request->get('user_id'));
        }

        if ($Request->has('created_at_date_type') && $Request->get('created_at_date_type') !== '') {
            $CreatedAtDateType = $Request->get('created_at_date_type');
            if ($CreatedAtDateType === 'custom') {
                if ($Request->get('start_date') === '' && $Request->get('end_date') === '') {
                    \Alert::error(TITLE_SELECT_STARTEND_DATE_FOR_CUSTOM_DATE_FILTER, MSG_SELECT_STARTEND_DATE_FOR_CUSTOM_DATE_FILTER);
                    return redirect()->route($this->RoutePrefixName.'.index');
                }
            }

            $query = getDateFilterQuery($query, $Request->get('created_at_date_type'));
        }

        if ($Request->has('start_date') && $Request->get('start_date') !== '') {
            $query = $query->where(\DB::raw('DATE(created_at)'), '>=', date('Y-m-d', strtotime($Request->get('start_date'))));
        }

        if ($Request->has('end_date') && $Request->get('end_date') !== '') {
            $query = $query->where(\DB::raw('DATE(created_at)'), '<=', date('Y-m-d', strtotime($Request->get('end_date'))));
        }

        if ($Request->has('perpage') && $Request->get('perpage') > 0) {
            $perpage = $Request->get('perpage');
        } else {
            $perpage = DASHBOARD_PER_PAGE_RECORDS;
        }

        $Records = $query->orderBy('updated_at', 'DESC')->paginate($perpage);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $RoutePrefixName = $this->RoutePrefixName;

        $ModuleViewFolder = $this->ViewFolder;

        $Users = Users::orderBy('id', 'DESC')->get();

        return view($this->ViewFolder.'.index', compact('Records', 'Module', 'RecordModule', 'RoutePrefixName', 'Request', 'ModuleViewFolder', 'Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for Show User Event Page
        @Author: Sandeep Gajera
        @Input: Event Id
        @Output: - Show Event data
        @Date: 08-07-2023
    */
    public function show($id)
    {
        $Record = UserEvents::where('id', $id)->first();

        $Module = $this->Module;

        $RecordShowModule = $this->RecordShowModule;

        $RoutePrefixName = $this->RoutePrefixName;

        $ModuleViewFolder = $this->ViewFolder;

        return view($this->ViewFolder.'.show', compact('Record', 'Module', 'RecordShowModule', 'RoutePrefixName', 'ModuleViewFolder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy()
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */

    public function status()
    {
    }
}
