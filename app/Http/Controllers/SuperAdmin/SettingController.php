<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public $Module = 'Setting';
    public $RecordModule = 'Setting';
    public $ViewFolder = VIEW_FOLDER_SUPERADMIN.'.setting';
    public $IncludeViewFolder = VIEW_FOLDER_SUPERADMIN.'.setting.include';
    public $ElementIncludeViewFolder = VIEW_FOLDER_SUPERADMIN.'.setting.include.elements';
    public $RoutePrefixName = 'setting';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for setting Page
        @Author: Sandeep Gajera
        @Input: setting type
        @Output: - setting data
        @Date: 07-07-2023
    */
    public function index($Type = '')
    {
        $Module = $this->Module;
        $RecordModule = $this->RecordModule;
        $RoutePrefixName = $this->RoutePrefixName;
        $ModuleViewFolder = $this->ViewFolder;
        $IncludeViewFolder = $this->IncludeViewFolder;
        $ElementIncludeViewFolder = $this->ElementIncludeViewFolder;

        $SelectedType = $Type;
        $j = 0;
        foreach (Settings::getType() as $Type) {
            $Settings = Settings::where('e_type', $Type)->where('e_is_editable', 'Yes')->where('e_status', 'Active')->orderBy('i_group_order', 'ASC')->get();
            if (! empty($Settings) && $Settings->count()) {
                $Types[$j]['e_type'] = $Type;

                //For Tab Settings
                $Types[$j]['setting_tabs'] = $Tabs = Settings::where('e_type', $Type)->where('e_is_editable', 'Yes')->where('e_tab', '!=', 'None')->groupBy('e_tab')->pluck('e_tab')->toArray();
                if (! empty($Tabs)) {
                    $Types[$j]['settings'] = [];
                    foreach ($Tabs as $TabKey => $Tab) {
                        $Types[$j]['tabs'][$TabKey]['e_tab'] = $Tab;
                        $Types[$j]['tabs'][$TabKey]['settings'] = Settings::where('e_type', $Type)->where('e_is_editable', 'Yes')->where('e_tab', $Tab)->orderBy('i_tab_group_order', 'ASC')->get();
                    }
                } else {
                    $Types[$j]['settings'] = $Settings;
                }

                $j++;
            }
        }

        if (count($Types)) {
            return view($this->ViewFolder.'.index', compact('Module', 'RecordModule', 'RoutePrefixName', 'Types', 'SelectedType', 'ModuleViewFolder', 'IncludeViewFolder', 'ElementIncludeViewFolder'));
        }
        \Alert::error(TITLE_RECORD_NOT_FOUND, MSG_RECORD_NOT_FOUND);
        return redirect()->route(ALIAS_SUPERADMIN.'dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    /*
        @Description: Function for Update setting
        @Author: Sandeep Gajera
        @Input: Input all data
        @Output: - Update Settiing
        @Date: 07-07-2023
    */
    public function store(Request $Request, $Type)
    {
        unset($Request['_token']);
        $Settings = Settings::where('e_type', $Type)->where('e_is_editable', 'Yes')->where('e_status', 'Active')->get();

        $CronJobAry = [
            'customer_live_activation_mail_cron_status' => '2',
            'customer_free_activation_mail_cron_status' => '3',
            'sales_person_new_partner_registered_report_mail_cron_status' => '4',
            'sales_person_new_partner_activation_report_mail_cron_status' => '5',
        ];

        if (! empty($Settings) && $Settings->count()) {
            foreach ($Settings as $Setting) {
                if ($Setting->e_form_element_type === Settings::FORM_ELEMENT_TYPE_CHECKBOX) {
                    $KeyName = $Setting->v_key;
                    if ($Request->$KeyName !== '') {
                        if (count($Request->$KeyName)) {
                            $Setting->t_value = json_encode($Request->$KeyName);
                            $Setting->save();
                        }
                    }
                } else {
                    $KeyName = $Setting->v_key;
                    $Setting->t_value = $Request->$KeyName;
                    $Setting->save();
                }

                $KeyName = $Setting->v_key;
                if (isset($CronJobAry[$KeyName])) {
                    CronJobs::where('id', $CronJobAry[$KeyName])->update(['e_status' => $Request->$KeyName]);
                }

                if (\Auth::guard(GUARD_SUPERADMIN)->check()) {
                    if ($Type === 'Email' && $Setting->e_tab === 'Email General') {
                        if ($KeyName === 'send_test_mail') {
                            if ($Request->$KeyName === 'Yes') {
                                if ($Request->send_test_mail_emailids !== '') {
                                    $TestMailEmailIds = explode(',', $Request->send_test_mail_emailids);

                                    if (count($TestMailEmailIds)) {
                                        \Mail::send('emails.smtp_mail_test', [], function ($message) use ($Request, $TestMailEmailIds) {
                                            $message->to($TestMailEmailIds)->subject('Testing mails send by using vibranium superadmin panel setting page ['.$Request->email_driver.']'.\Auth::guard(GUARD_SUPERADMIN)->user()->v_email_id);
                                        });
                                        $Setting->t_value = 'No';
                                        $Setting->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        \Alert::success(TITLE_RECORD_UPDATED, MSG_RECORD_UPDATED);
        return redirect()->route($this->RoutePrefixName.'.index', ['type' => $Type]);
    }
}
