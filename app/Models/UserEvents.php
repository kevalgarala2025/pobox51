<?php

namespace App\Models;

use Carbon\Carbon;

class UserEvents extends OcModel
{
    public const STATUS_ACTIVE = 'Active';
    public const STATUS_COMPLETED = 'Completed';
    protected $table = 'user_events';

    protected $fillable = ['*'];

    protected $appends = ['i_event_display_total_time'];

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($UserEvent) {
            UserEventParticipants::where('i_user_event_id', $UserEvent->id)->delete();
        });
    }

    public function getIEventDisplayTotalTimeAttribute()
    {
        if (! empty($this->i_event_contact_share_total_time_in_seconds) && $this->i_event_contact_share_total_time_in_seconds > 0) {
            return gmdate('i:s', $this->i_event_contact_share_total_time_in_seconds);
        }
        return 0;
    }

    public function user_event_participants()
    {
        return $this->hasMany('App\Models\UserEventParticipants', 'i_user_event_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\Users', 'id', 'i_user_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return empty($value) ? '' : Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getDEventSharingCompletedDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
