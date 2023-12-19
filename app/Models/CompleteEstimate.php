<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteEstimate extends Model
{
    use HasFactory;

    protected $table = 'complete_estimates';

    protected $primaryKey = 'complete_estimate_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_completed_by',
        'estimate_assigned_to_accept',
        'acceptence_start_date',
        'acceptence_end_date',
        'note',
    ];

    public $timestamps = true;

}
