<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    use HasFactory;

    protected $table = 'estimate_items';

    protected $primaryKey = 'estimate_item_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'item_id',
        'item_name',
        'item_type',
        'item_unit',
        'item_cost',
        'item_price',
        'labour_expense',
        'material_expense',
        'item_qty',
        'item_total',
        'item_Description',
        'item_note',
    ];

    public $timestamps = true;

}
