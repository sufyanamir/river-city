<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateImage extends Model
{
    use HasFactory;

    // EstimateImage.php

    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id');
    }


    protected $table = 'estimate_images';

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_image',
    ];

    public $timestamps = true;
}
