<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvancePayment extends Model
{
    use HasFactory;

    protected $table = 'advance_payments';

    protected $primaryKey = 'advance_payment_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_total',
        'advance_payment',
        'advance_paid_sts',
        'note',
    ];

    public $timestamps = true;
    
}
