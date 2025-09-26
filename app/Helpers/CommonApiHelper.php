<?php

namespace App\Helpers;

class CommonApiHelper
{
    public static function generate_api_token($mobile_number)
    {
        return md5(time().\Str::random(30)).md5($mobile_number).md5(\Str::random(30).time());
    }
    public static function generate_reset_token()
    {
        return md5(time().\Str::random(6));
    }
}
