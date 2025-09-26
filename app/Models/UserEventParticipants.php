<?php

namespace App\Models;

class UserEventParticipants extends OcModel
{
    protected $table = 'user_event_participants';

    protected $fillable = ['*'];

    public static function boot()
    {
        parent::boot();

        self::deleting(function () {
        });
    }

    public function user_event()
    {
        return $this->hasOne('App\Models\UserEvents', 'id', 'i_user_event_id');
    }
}
