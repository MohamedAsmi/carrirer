<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTracking extends Model
{
    use HasFactory;

    protected $table = 'job_tracking';
    protected $fillable = ['status', 'details', 'user_id', 'job_class'];

    public static function getStatus($userId, $jobClass)
    {
        return JobTracking::where('user_id', $userId)->where('job_class', $jobClass)->first();
    }
}
