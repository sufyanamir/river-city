<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateActivity extends Model
{
    use HasFactory;

    protected $table = 'estimate_activity';

    protected $primaryKey = 'estimate_activity_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'activity_title',
        'activity_description',
    ];

    public $timestamps = true;

}
