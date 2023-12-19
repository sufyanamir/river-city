<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleWork extends Model
{
    use HasFactory;

    protected $table = 'schedule_work';

    protected $primaryKey = 'schedule_work_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'schedule_assigned',
        'schedule_assign_id',
        'schedule_start_date',
        'schedule_end_date',
        'note',
    ];

    public $timestamps = true;

}
