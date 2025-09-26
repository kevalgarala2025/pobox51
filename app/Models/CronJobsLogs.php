<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CronJobsLogs extends Model
{
    public $timestamps = true;
    protected $table = 'cron_job_logs';
}
