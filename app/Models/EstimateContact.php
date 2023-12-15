<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateContact extends Model
{
    use HasFactory;

    protected $table = 'estimate_contacts';

    protected $primaryKey = 'contact_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'contact_title',
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_phone',
    ];

    public $timestamps = true;

}
