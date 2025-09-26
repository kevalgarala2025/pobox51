<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public $Module = 'Users';

    public $RecordModule = 'User';

    public $RecordAddModule = 'Add User';

    public $RecordEditModule = 'Edit User';

    public $RecordShowModule = 'View User';

    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.user';

    public $RoutePrefixName = 'users';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for User First Page
        @Author: Sandeep Gajera
        @Input:
        @Output: - All User data
        @Date: 07-07-2023
    */
    public function index(Request $Request)
    {
        $query = new Users();

        if ($Request->has('keyword') && $Request->get('keyword') !== '') {
            $query = $query->where('v_phone_no', 'LIKE', '%'.$Request->get('keyword').'%')

                ->oRwhere('v_first_name', 'LIKE', '%'.$Request->get('keyword').'%')

                ->oRwhere('v_middle_name', 'LIKE', '%'.$Request->get('keyword').'%')

                ->oRwhere('v_last_name', 'LIKE', '%'.$Request->get('keyword').'%')

                ->oRwhere('v_email', 'LIKE', '%'.$Request->get('keyword').'%');
        }

        if ($Request->has('status') && $Request->get('status') !== '') {
            $query = $query->where('e_status', '=', $Request->get('status'));
        }

        if ($Request->has('perpage') && $Request->get('perpage') > 0) {
            $perpage = $Request->get('perpage');
        } else {
            $perpage = DASHBOARD_PER_PAGE_RECORDS;
        }

        $Records = $query->withCount('user_events as i_user_event_count')->orderBy('updated_at', 'DESC')->paginate($perpage);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $RecordAddModule = $this->RecordAddModule;

        $RoutePrefixName = $this->RoutePrefixName;

        $ModuleViewFolder = $this->ViewFolder;

        return view($this->ViewFolder.'.index', compact('Records', 'Module', 'RecordModule', 'RecordAddModule', 'RoutePrefixName', 'Request', 'ModuleViewFolder'));
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
        @Description: Function for Show User Data
        @Author: Sandeep Gajera
        @Input: User Id
        @Output: - User data
        @Date: 07-07-2023
    */
    public function show($id)
    {
        $Record = Users::where('id', $id)->withCount('user_events as i_user_event_count')->first();

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
    /*
        @Description: Function for User Edit Page
        @Author: Sandeep Gajera
        @Input: User id
        @Output: - Edit Page
        @Date: 07-07-2023
    */
    public function edit($id)
    {
        $Record = Users::findOrFail($id);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $RecordEditModule = $this->RecordEditModule;

        $RoutePrefixName = $this->RoutePrefixName;

        $ModuleViewFolder = $this->ViewFolder;

        return view($this->ViewFolder.'.add-edit', compact('Record', 'Module', 'RecordModule', 'RecordEditModule', 'RoutePrefixName', 'ModuleViewFolder'));
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
    /*
        @Description: Function for Update User Data
        @Author: Sandeep Gajera
        @Input: Filld All Data
        @Output: - Update User Data
        @Date: 07-07-2023
    */
    public function update(Request $request, $id)
    {
        $request->validate(
            [

                'v_first_name' => 'required',

                'v_middle_name' => 'required',

                'v_last_name' => 'required',

                'v_email' => 'required|unique:users,v_email,' . $id,

                'v_phone_no' => 'required|unique:users,v_phone_no,' . $id,

            ],
            [
                'v_email.unique' => 'User email already exist.',

                'v_phone_no.unique' => 'User mobile number already exist.',

                'v_first_name.required' => 'First Name is required',

                'v_middle_name.required' => 'Middle Name is required',

                'v_last_name.required' => 'Last Name is required',

                'v_email.required' => 'Email is required',

                'v_phone_no.required' => 'Mobile number is required',

            ]
        );

        try {
            $Records = Users::findOrFail($id);

            $Records->v_phone_no = $request->v_phone_no;

            $Records->v_first_name = $request->v_first_name;

            $Records->v_middle_name = $request->v_middle_name;

            $Records->v_last_name = $request->v_last_name;

            $Records->v_email = $request->v_email;

            if ($request->hasFile('v_profile_pic')) {
                $file_name = imageUpload($request->file('v_profile_pic'), USER_PROFILE_PIC_IMG_PATH);

                $Records->v_profile_pic = $file_name;
            }

            if ($request->t_password !== '') {
                $Records->t_password = Hash::make($request->t_password);
            }

            $Records->save();

            DB::commit();

            \Alert::success(TITLE_RECORD_UPDATED, MSG_RECORD_UPDATED);
        } catch (\Exception $e) {
            DB::rollback();

            \Alert::error(TITLE_SOMETHING_WENT_WRONG_AT_SERVER, $e->getMessage());
        }

        return redirect()->route($this->RoutePrefixName.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for Delete User Data
        @Author: Sandeep Gajera
        @Input: User Id
        @Output: - Delete User Data
        @Date: 07-07-2023
    */
    public function destroy($id)
    {
        Users::destroy($id);

        \Alert::success(TITLE_RECORD_DELETED, MSG_RECORD_DELETED);

        return redirect()->route($this->RoutePrefixName.'.index');
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
    /*
        @Description: Function for Update User Status
        @Author: Sandeep Gajera
        @Input: User Id, Request
        @Output: - Update User Status
        @Date: 07-07-2023
    */
    public function status(Request $request, $id)
    {
        $Record = Users::findOrFail($id);

        $Record->e_status = $request->e_status;

        $Record->save();
    }
}
