<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table= 'emails';

    protected $primaryKey = 'email_id';

    protected  $fillable = [
        'email_name',
        'email_type',
        'email_to',
        'email_subject',
        'email_body',
        'email_format',
        'email_attachments',
    ];

    public $timestamps = true;

}
