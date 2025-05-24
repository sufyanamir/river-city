<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdPartyClient extends Model
{
    use HasFactory;

    protected $table = 'third_party_clients';
    protected $primaryKey = 'client_id';
    protected $fillable = [
        'client_id',
        'api_key'
    ];

}
