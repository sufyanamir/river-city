<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateChat extends Model
{
    use HasFactory;

    protected $table = 'estimate_chat';

    protected $primaryKey = 'estimate_chat_id';

    protected $fillable = [
        'estimate_id',
        'added_user_id',
        'added_user_name',
        'chat_message',
        'chat_image',
        'chat_emojis',
        'mentioned_user_ids',
    ];

    public $timestamps = true;
    
    public function addedUser()
    {
        return $this->belongsTo(User::class, 'added_user_id', 'id');
    }

}
