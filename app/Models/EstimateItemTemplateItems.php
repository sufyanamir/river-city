<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItemTemplateItems extends Model
{
    use HasFactory;

    protected $table = 'estimate_item_template_items';

    protected $primaryKey = 'est_template_item_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'est_template_id',
        'item_id',
        'item_qty',
        'item_total',
        'labour_expense',
        'material_expense',
        'item_cost',
        'item_price',
        'item_description',
        'item_note',
        'item_type',
    ];

    public $timestamps = true;

}
