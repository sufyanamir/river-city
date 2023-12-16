<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateEmail extends Model
{
    use HasFactory;

    protected $table = 'estimate_emails';

    protected $primaryKey = 'estimate_email_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'email_id',
        'email_name',
        'email_to',
        'email_subject',
        'email_body',
    ];

    public $timestamps = true;

}
