<?php
if (! function_exists('getPerPageRecordList')) {
    function getPerPageRecordList()
    {
        return [10,25,50,100,500,1000];
    }
}

if (! function_exists('getYear')) {
    function getYear()
    {
        $val = [];
        for ($i = 1990;$i < 2021;$i++) {
            $val[$i] = $i;
        }
        return $val;
    }
}

if (! function_exists('getSettings')) {
    function getSettings($SettingKey = '')
    {
        $Query = new App\Models\Settings();

        if (is_array($SettingKey)) {
            if (count($SettingKey)) {
                return $Query->whereIn('v_key', array_values($SettingKey))->pluck('t_value', 'v_key')->toArray();
            }
        } else {
            if (! empty($SettingKey)) {
                $Setting = $Query->where('v_key', $SettingKey)->first();

                if (! empty($Setting)) {
                    return $Setting->t_value;
                }
            }
        }
        return '';
    }
}

if (! function_exists('generateRandomString')) {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (! function_exists('imageUpload')) {
    function imageUpload($file, $destinationPath)
    {
        $image_name = date('Ymd').'_'.\Str::random(10). '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $image_name);
        return $image_name;
    }
}
if (! function_exists('fileUpload')) {
    function fileUpload($file, $destinationPath)
    {
        $file_name = date('Ymd').'_'.\Str::random(10). '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $file_name);
        return $file_name;
    }
}

if (! function_exists('generateApiToken')) {
    function generateApiToken($mobilenumber)
    {
        return md5(time().\Str::random(30)).md5($mobilenumber).md5(\Str::random(30).time());
    }
}

if (! function_exists('getUsersStatusClass')) {
    function getUsersStatusClass($status)
    {
        $StatusClass = [
            App\Models\Users::STATUS_PENDING => 'sky-tag-bg',
            App\Models\Users::STATUS_APPROVED => 'green-tag-bg',
            App\Models\Users::STATUS_REJECTED => 'red-tag-bg',
            App\Models\Users::STATUS_LOGOUT => 'purple-tag-bg',
        ];
        if (isset($StatusClass[$status])) {
            return $StatusClass[$status];
        }
    }
}

if (! function_exists('getUserEventStatusClass')) {
    function getUserEventStatusClass($status)
    {
        $StatusClass = [
            App\Models\UserEvents::STATUS_ACTIVE => 'sky-tag-bg',
            App\Models\UserEvents::STATUS_COMPLETED => 'green-tag-bg',
        ];
        if (isset($StatusClass[$status])) {
            return $StatusClass[$status];
        }
    }
}

if (! function_exists('getUsersStatus')) {
    function getUsersStatus()
    {
        return ['Active','Inactive'];
    }
}

if (! function_exists('getUsersLoginActions')) {
    function getUsersLoginActions()
    {
        return ['Pending','Approved','Reject','Logout'];
    }
}

if (! function_exists('getEnumValues')) {
    function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = [];
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = \Arr::add($enum, $v, $v);
        }
        return $enum;
    }
}

if (! function_exists('getDateTypeFilterOptions')) {
    function getDateTypeFilterOptions()
    {
        return [

            'till_now' => 'Till Now',

            'today' => 'Today',

            'yesterday' => 'Yesterday',

            'last_week' => 'Last Week',

            'current_week' => 'Current Week',

            'last_month' => 'Last Month',

            'current_month' => 'Current Month',

            'last_year' => 'Last Year',

            'current_year' => 'Current Year',

        ];
    }
}

if (! function_exists('getDateTypeFilterStartDateEndDate')) {
    function getDateTypeFilterStartDateEndDate($DateFilterType = '')
    {
        if ($DateFilterType !== '') {
            if ($DateFilterType === 'today') {
                return [

                    \Carbon::today()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::today()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'yesterday') {
                return [

                    \Carbon::yesterday()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::yesterday()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'last_week') {
                return [

                    \Carbon::now()->subWeek()->startOfWeek()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::now()->subWeek()->endOfWeek()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'current_week') {
                return [

                    \Carbon::now()->startOfWeek()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::today()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'last_month') {
                return [

                    \Carbon::now()->subMonth()->startOfMonth()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::now()->subMonth()->endOfMonth()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'current_month') {
                return [

                    \Carbon::now()->startOfMonth()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::today()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'last_year') {
                return [

                    \Carbon::now()->subYear()->startOfYear()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::now()->subYear()->endOfYear()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }

            if ($DateFilterType === 'current_year') {
                return [

                    \Carbon::now()->startOfYear()->format(DATABASE_STORE_DATE_FORMAT),

                    \Carbon::today()->format(DATABASE_STORE_DATE_FORMAT),

                ];
            }
        }

        return [];
    }
}

if (! function_exists('getDateFilterQuery')) {
    function getDateFilterQuery($Query, $DateFilterType = '', $FieldName = 'created_at')
    {
        if ($DateFilterType === 'today') {
            $Query = $Query->whereDate($FieldName, \Carbon::today()->format(DATABASE_STORE_DATE_FORMAT));
        } elseif ($DateFilterType === 'yesterday') {
            $Query = $Query->whereDate($FieldName, \Carbon::yesterday()->format(DATABASE_STORE_DATE_FORMAT));
        } elseif ($DateFilterType === 'last_week') {
            $Query = $Query->whereBetween(
                $FieldName,
                [\Carbon::now()->subWeek()->startOfWeek(),\Carbon::now()->subWeek()->endOfWeek()]
            );
        } elseif ($DateFilterType === 'current_week') {
            $Query = $Query->whereBetween(
                $FieldName,
                [\Carbon::now()->startOfWeek(), \Carbon::now()->endOfWeek()]
            );
        } elseif ($DateFilterType === 'last_month') {
            $Query = $Query->whereMonth($FieldName, \Carbon::now()->subMonth()->month);
        } elseif ($DateFilterType === 'current_month') {
            $Query = $Query->whereMonth($FieldName, \Carbon::now()->month);
        } elseif ($DateFilterType === 'last_year') {
            $Query = $Query->whereYear($FieldName, \Carbon::now()->subYear()->year);
        } elseif ($DateFilterType === 'current_year') {
            $Query = $Query->whereBetween($FieldName, [

                \Carbon::now()->startOfYear(),

                \Carbon::now()->endOfYear(),

            ]);
        }

        return $Query;
    }
}

if (! function_exists('getDateFilterMultipleKeysQuery')) {
    function getDateFilterMultipleKeysQuery($Query, $DateFilterType = '', $FieldName1 = 'created_at', $FieldName2 = 'created_at')
    {
        if ($DateFilterType !== 'till_now' || $DateFilterType !== 'custom') {
            if ($DateFilterType === 'today') {
                $Query = $Query->whereRaw('CURDATE() between '.$FieldName1.' and '.$FieldName2);
            } elseif ($DateFilterType === 'yesterday') {
                $Query = $Query->whereRaw('DATE_SUB(CURDATE(), INTERVAL 1 DAY) between '.$FieldName1.' and '.$FieldName2);
            } elseif ($DateFilterType === 'last_week') {
                $Query = $Query->Where(function ($Query2) {
                    $Query2->whereBetween($FieldName1, [\Carbon::now()->subWeek()->startOfWeek(),\Carbon::now()->subWeek()->endOfWeek()])->orWhereBetween($FieldName2, [\Carbon::now()->subWeek()->startOfWeek(),\Carbon::now()->subWeek()->endOfWeek()]);
                });
            } elseif ($DateFilterType === 'current_week') {
                $Query = $Query->Where(function ($Query2) {
                    $Query2->whereBetween($FieldName1, [\Carbon::now()->startOfWeek(), \Carbon::now()->endOfWeek()])->orWhereBetween($FieldName2, [\Carbon::now()->startOfWeek(), \Carbon::now()->endOfWeek()]);
                });
            } elseif ($DateFilterType === 'last_month') {
                $Query = $Query->Where(function ($Query2) use ($FieldName1, $FieldName2) {
                    $Query2->whereMonth($FieldName1, \Carbon::now()->subMonth()->month)->orWhereMonth($FieldName2, \Carbon::now()->subMonth()->month);
                });
            } elseif ($DateFilterType === 'current_month') {
                $Query = $Query->Where(function ($Query2) use ($FieldName1, $FieldName2) {
                    $Query2->whereMonth($FieldName1, \Carbon::now()->month)->orWhereMonth($FieldName2, \Carbon::now()->month);
                });
            } elseif ($DateFilterType === 'last_year') {
                $Query = $Query->Where(function ($Query2) use ($FieldName1, $FieldName2) {
                    $Query2->whereYear($FieldName1, \Carbon::now()->subYear()->year)->orWhereYear($FieldName2, \Carbon::now()->subYear()->year);
                });
            } elseif ($DateFilterType === 'current_year') {
                $Query = $Query->Where(function ($Query2) use ($FieldName1, $FieldName2) {
                    $Query2->whereBetween($FieldName1, [\Carbon::now()->startOfYear(),\Carbon::now()->endOfYear()])->orWhereBetween($FieldName2, [\Carbon::now()->endOfYear(),\Carbon::now()->endOfYear()]);
                });
            }
        }

        return $Query;
    }
}
