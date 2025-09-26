<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SuperAdmin extends Authenticatable
{
    use Notifiable;

    protected $appends = ['i_role_id','v_profile_pic_path'];

    protected $table = 'super_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'v_name', 'v_email_id', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'd_last_login_date' => 'datetime',
    ];

    public function getIRoleIdAttribute()
    {
        return Roles::find(1)->id;
    }
    public function getVProfilePicPathAttribute()
    {
        if (! empty($this->v_profile_image)) {
            $file_path = ADMIN_PROFILE_PIC_IMG_PATH.$this->v_profile_image;
            if (file_exists($file_path)) {
                return env('APP_URL').ADMIN_PROFILE_PIC_IMG_PATH.$this->v_profile_image;
            }
        }
        return '';
    }
}
