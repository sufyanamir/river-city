<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateNote extends Model
{
    use HasFactory;

    protected $table = 'estimate_notes';

    protected $primaryKey = 'estimate_note_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_note',
    ];

    public $timestamps = true;

}
