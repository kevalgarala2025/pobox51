<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes;

    public const STATUS_ACTIVE = 'Active';
    public const STATUS_INACTIVE = 'Inactive';
    public const STATUS_IN_PROGRESS = 'In Progress';
    public const STATUS_PENDING_VERIFICATION = 'Pending Verification';
    public $timestamps = true;
    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $guarded = [];
    protected $appends = ['v_full_name','v_profile_pic_path'];

    public function getVProfilePicPathAttribute()
    {
        if (! empty($this->v_profile_pic)) {
            $file_path = USER_PROFILE_PIC_IMG_PATH.$this->v_profile_pic;
            if (file_exists($file_path)) {
                return env('APP_URL').USER_PROFILE_PIC_IMG_PATH.$this->v_profile_pic;
            }
        }
        return env('APP_URL').DEFAULT_FILE_PATH.'default-avatar.png';
    }

    public function getVFullNameAttribute()
    {
        $names = [$this->v_first_name,$this->v_middle_name,$this->v_last_name];

        return implode(' ', array_filter($names));
    }

    public function user_events()
    {
        return $this->hasMany('App\Models\UserEvents', 'i_user_id');
    }
}
