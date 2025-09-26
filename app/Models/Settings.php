<?php

namespace App\Models;

class Settings extends OcModel
{
    public const FORM_ELEMENT_TYPE_TEXTBOX = 'TextBox';
    public const FORM_ELEMENT_TYPE_NUMBER = 'Number';
    public const FORM_ELEMENT_TYPE_SELECTBOX = 'SelectBox';
    public const FORM_ELEMENT_TYPE_RADIO = 'Radio';
    public const FORM_ELEMENT_TYPE_CHECKBOX = 'CheckBox';
    public const FORM_ELEMENT_TYPE_TEXTAREA = 'TextArea';
    public const FORM_ELEMENT_TYPE_TEXTAREA_EDITOR = 'TextAreaEditor';
    public const FORM_ELEMENT_TYPE_DATE = 'Date';
    public const FORM_ELEMENT_TYPE_NONE = 'None';

    public const TYPE_CRON = 'General';
    public const TYPE_EVENT = 'Event';
    public const TYPE_EVENT_USER = 'Event User';
    public const TYPE_EVENT_PARTICIPANT = 'Event Participant';
    public const TYPE_EMAIL = 'Email';
    public const TYPE_NONE = 'None';
    protected $table = 'settings';

    public static function getType()
    {
        $Settings = new Settings();
        $TableName = $Settings->getTable();
        return getEnumValues(env('DB_PREFIX').$TableName, 'e_type');
    }

    public static function getFormElementTypes()
    {
        $Settings = new Settings();
        $TableName = $Settings->getTable();
        return getEnumValues(env('DB_PREFIX').$TableName, 'e_form_element_type');
    }
}
