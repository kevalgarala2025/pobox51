<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\CMSPages;
use Illuminate\Http\Request;

class CMSPageController extends BaseController
{
    public $Module = 'CMSPages';

    public $RecordModule = 'CMSPage';

    public $RecordEditModule = 'Edit CMSPage';

    public $RecordShowModule = 'View CMSPage';

    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.cms-page';

    public $RoutePrefixName = 'cms-pages';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*
        @Description: Function for CMS page
        @Author: Sandeep Gajera
        @Input:
        @Output: - Redirect index page with data
        @Date: 04-07-2023
    */
    public function index(Request $request)
    {
        $query = new CMSPages();

        if ($request->has('keyword') && $request->get('keyword') !== '') {
            $query = $query->where('v_name', 'LIKE', '%'.$request->get('keyword').'%');
        }

        if ($request->has('perpage') && $request->get('perpage') > 0) {
            $perpage = $request->get('perpage');
        } else {
            $perpage = DASHBOARD_PER_PAGE_RECORDS;
        }

        $Records = $query->orderBy('v_name', 'ASC')->paginate($perpage);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;
        $RoutePrefixName = $this->RoutePrefixName;
        $ModuleViewFolder = $this->ViewFolder;

        return view($this->ViewFolder.'.index', compact('Records', 'Module', 'RecordModule', 'RoutePrefixName', 'ModuleViewFolder'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for Show CMSPage data
        @Author: Sandeep Gajera
        @Input: CMSPage  Id
        @Output: - Redirect CMSPage Data
        @Date: 04-07-2023
    */
    public function show($id)
    {
        $Record = CMSPages::where('id', $id)->first();
        $Module = $this->Module;
        $RecordShowModule = $this->RecordShowModule;
        $RoutePrefixName = $this->RoutePrefixName;
        return view($this->ViewFolder.'.show', compact('Record', 'Module', 'RecordShowModule', 'RoutePrefixName'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */

    /*
        @Description: Function for Edit CMSPage Data
        @Author: Sandeep Gajera
        @Input: User Id
        @Output: - CMSPage data
        @Date: 04-07-2023
    */
    public function edit($id)
    {
        $CMSPage = CMSPages::findOrFail($id);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $RecordEditModule = $this->RecordEditModule;
        $RoutePrefixName = $this->RoutePrefixName;
        $ModuleViewFolder = $this->ViewFolder;
        return view($this->ViewFolder.'.add-edit', compact('CMSPage', 'Module', 'RecordModule', 'RecordEditModule', 'RoutePrefixName', 'ModuleViewFolder'));
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
        @Description: Function for CMSPage Update
        @Author: Sandeep Gajera
        @Input: Fill All Form Data
        @Output: - Update CMSPage data
        @Date: 04-07-2023
    */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'v_name' => 'required|unique:cms_pages,v_name,' . $id,
            ],
            [
                'v_name.required' => 'CMS Page is required',
                'v_name.unique' => 'CMS Page already exist.',
            ]
        );

        $Record = CMSPages::findOrFail($id);

        $Record->update($request->all());

        $Record->v_slug = \Str::slug($request->v_name);

        $Record->save();

        \Alert::success(TITLE_RECORD_UPDATED, MSG_RECORD_UPDATED);

        return redirect()->route($this->RoutePrefixName.'.index');
    }
}
