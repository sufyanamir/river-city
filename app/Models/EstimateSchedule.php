<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateSchedule extends Model
{
    use HasFactory;

    protected $table = 'estimate_schedule';

    protected $primaryKey = 'estimate_schedule_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_complete_assigned_to',
        'start_date',
        'end_date',
        'note',
    ];

    public $timestamp = true;

}
