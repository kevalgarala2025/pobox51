<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\EmailTemplates;
use Illuminate\Http\Request;

class EmailTemplateController extends BaseController
{
    public $Module = 'Email Templates';

    public $RecordModule = 'Email Template';

    public $RecordAddModule = 'Add Email Template';

    public $RecordEditModule = 'Edit Email Template';

    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.email-template';

    public $RoutePrefixName = 'email-templates';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for Email Templates
        @Author: Sandeep Gajera
        @Input: Email, Subject
        @Output: - Reditect with template data
        @Date: 06-07-2023
    */
    public function index(Request $request)
    {
        $query = new EmailTemplates();

        if ($request->has('keyword') && $request->get('keyword') !== '') {
            $query = $query->where('v_template_name', 'LIKE', '%'.$request->get('keyword').'%')

                ->oRwhere('v_subject', 'LIKE', '%'.$request->get('keyword').'%')

                ->oRwhere('v_from_email_id', 'LIKE', '%'.$request->get('keyword').'%');
        }

        if ($request->has('perpage') && $request->get('perpage') > 0) {
            $perpage = $request->get('perpage');
        } else {
            $perpage = DASHBOARD_PER_PAGE_RECORDS;
        }

        $Records = $query->orderBy('v_template_name', 'ASC')->paginate($perpage);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $RecordAddModule = $this->RecordAddModule;

        $RoutePrefixName = $this->RoutePrefixName;

        return view($this->ViewFolder.'.index', compact('Records', 'Module', 'RecordModule', 'RecordAddModule', 'RoutePrefixName'));
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

    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for Edit Tamplate
        @Author: Sandeep Gajera
        @Input: Template Id
        @Output: - Template data
        @Date: 06-07-2023
    */
    public function edit($id)
    {
        $Record = EmailTemplates::findOrFail($id);

        $Module = $this->Module;

        $RecordModule = $this->RecordModule;

        $RecordEditModule = $this->RecordEditModule;

        $RoutePrefixName = $this->RoutePrefixName;

        return view($this->ViewFolder.'.add-edit', compact('Record', 'Module', 'RecordModule', 'RecordEditModule', 'RoutePrefixName'));
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
        @Description: Function for Update emailtemplate
        @Author: Sandeep Gajera
        @Input: template id, new subject
        @Output: - update emailtemplate
        @Date: 06-07-2023
    */
    public function update(Request $request, $id)
    {
        $request->validate(
            [

                'v_subject' => 'required|unique:email_templates,v_subject,' . $id,

            ],
            [

                'v_subject.required' => 'Email template subject is required',

                'v_subject.unique' => 'Email template subject already exist.',

            ]
        );

        $Record = EmailTemplates::findOrFail($id);

        $Record->v_template_name = $request->v_template_name;

        $Record->v_subject = $request->v_subject;

        $Record->v_from_email_id = $request->v_from_email_id;

        $Record->v_template_body = $request->v_template_body;

        $Record->save();

        \Alert::success(TITLE_RECORD_UPDATED, MSG_RECORD_UPDATED);

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
        @Description: Function for Delete emailtemplate
        @Author: Sandeep Gajera
        @Input: emailtemplate id
        @Output: - delete emailtemplate database
        @Date: 06-07-2023
    */
    public function destroy($id)
    {
        EmailTemplates::destroy($id);

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
        @Description: Function for Update emailtemplate Status
        @Author: Sandeep Gajera
        @Input: emailtemplate id, request
        @Output: - Update emailtemplate status
        @Date: 06-07-2023
    */
    public function status(Request $request, $id)
    {
        $Record = EmailTemplates::findOrFail($id);

        $Record->update($request->all());

        $Record->save();
    }
}
