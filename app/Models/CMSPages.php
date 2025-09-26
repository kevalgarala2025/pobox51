<?php

namespace App\Models;

class CMSPages extends OcModel
{
    public $timestamps = true;
    protected $table = 'cms_pages';
    protected $fillable = ['e_type','v_name','t_page_content','e_status'];
}
