<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleEstimate extends Model
{
    use HasFactory;

    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id');
    }

    public function assigenedUser()
    {
        return $this->belongsTo(User::class, 'work_assign_id');
    }

    protected $table = 'schedule_estimates';
    
    protected $primaryKey = 'schedule_estimate_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'start_date',
        'end_date',
        'work_assigned',
        'work_assign_id',
        'note',
    ];

    public $timestamps = true;

}
