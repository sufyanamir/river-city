<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateFile extends Model
{
    use HasFactory;

    protected $table = 'estimate_files';

    protected $primaryKey = 'estimate_file_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_file_name',
        'estimate_file',
    ];

    public $timestamps = true;

}
