<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignPayment extends Model
{
    use HasFactory;

    protected $table = 'estimate_complete_invoice';

    protected $primaryKey = 'estimate_complete_invoice_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'payment_assigned_to',
        'start_date',
        'end_date',
        'note',
        'complete_invoice_date',
        'invoice_name',
        'tax_rate',
        'invoice_total',
        'invoice_due',
        'invoice_status',
        'invoice_subtotal',
    ];

    public $timestamps = true;

    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id');
    }

}
