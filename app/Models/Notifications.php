<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'notification_message',
        'mentioned_user_id',
        'notification_type',
    ];

    public $timestamps = true;

}
