<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteEstimateInvoiceWork extends Model
{
    use HasFactory;

    protected $table = 'estimate_invoice_work';

    protected $primaryKey = 'estimate_invoice_work_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'invoice_assigned_to',
        'start_date',
        'end_date',
    ];

    public $timestamps = true;

}
