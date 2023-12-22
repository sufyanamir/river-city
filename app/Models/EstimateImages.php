<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateImages extends Model
{
    use HasFactory;

    protected $table = 'estimate_images';

    protected $primaryKey = 'estimate_image_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_image',
    ];

    public  $timestamps = true;

}
