<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateExpenses extends Model
{
    use HasFactory;

    protected $table = 'estimate_expenses';

    protected $primaryKey = 'estimate_expense_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'expense_date',
        'expense_item_type',
        'expense_vendor',
        'labour_hours',
        'expense_subtotal',
        'expense_tax',
        'expense_total',
        'expense_paid',
        'expense_description',
    ];

    public $timestamps = true;

}
