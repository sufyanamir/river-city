<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserToDo extends Model
{
    use HasFactory;

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'to_do_assigned_to');
    }

    protected $table = 'user_to_do_list';

    protected $primaryKey = 'to_do_id';

    protected $fillable = [
        'added_user_id',
        'to_do_title',
        'to_do_address',
        'to_do_status',
        'note',
        'start_date',
        'end_date',
        'to_do_assigned_to',
    ];

    public $timestamps = true;

}
