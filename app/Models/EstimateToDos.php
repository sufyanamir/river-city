<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateToDos extends Model
{
    use HasFactory;

    protected $table = 'estimate_to_dos';

    protected $primaryKey = 'to_do_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'to_do_title',
        'to_do_assigned_to',
        'start_date',
        'end_date',
        'note',
        'to_do_status',
    ];

    public $timestamps = true;

}
