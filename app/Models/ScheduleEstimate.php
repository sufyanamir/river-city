<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleEstimate extends Model
{
    use HasFactory;

    protected $table = 'schedule_estimates';
    
    protected $primaryKey = 'schedule_estimate_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimator',
        'start_date',
        'end_date',
    ];

    public $timestamps = true;

}
