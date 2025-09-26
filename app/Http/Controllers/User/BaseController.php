<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        \View::share(['ViewFolder' => VIEW_FOLDER_USER]);
    }
}
