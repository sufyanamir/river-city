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
        'attachment',
    ];

    public  $timestamps = true;

    public function chat()
    {
        return $this->hasMany(EstimateImageChat::class, 'estimate_image_id', 'estimate_image_id')->orderBy('estimate_image_chat_id', 'desc');
    }

}
