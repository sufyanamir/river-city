<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'added_user_id',
        'customer_first_name',
        'customer_last_name',
        'customer_email',
        'customer_phone',
        'customer_company_name',
        'customer_project_name',
        'customer_project_number',
        'customer_primary_address',
        'customer_secondary_address',
        'customer_city',
        'customer_state',
        'customer_zip_code',
        'tax_rate',
        'potential_value',
        'internal_note',
        'source',
        'owner',
    ];

    public $timestamps = true;

}
