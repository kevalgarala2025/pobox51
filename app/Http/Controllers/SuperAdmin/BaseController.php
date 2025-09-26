<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        \View::share(['ViewFolder' => VIEW_FOLDER_SUPERADMIN]);
    }
}
