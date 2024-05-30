<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatePayments extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->belongsTo(AssignPayment::class, 'estimate_complete_invoice_id');
    }

    protected $table = 'estimate_payments';

    protected $primaryKey = 'estimate_payment_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_complete_invoice_id',
        'complete_invoice_date',
        'invoice_total',
        'note',
    ];

    public $timestamps = true;

}
