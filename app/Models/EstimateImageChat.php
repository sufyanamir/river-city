<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateImageChat extends Model
{
    use HasFactory;

    protected $table = 'estimate_image_chat';

    protected $primaryKey = 'estimate_image_chat_id';

    protected $fillable = [
        'estimate_image_id',
        'user_id',
        'user_name',
        'message',
        'mentioned_users',
    ];

    public $timestamps = true;

}
