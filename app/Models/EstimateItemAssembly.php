<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItemAssembly extends Model
{
    use HasFactory;

    protected $table = 'estimate_item_assemblies';

    protected $primaryKey = 'estimate_item_assembly_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'estimate_item_id',
        'est_ass_item_name',
        'item_unit_by_ass_unit',
        'ass_unit_by_item_unit',
        'item_id',
        'ass_item_cost',
        'ass_item_price',
        'ass_item_qty',
        'ass_item_total',
        'ass_item_unit',
        'ass_item_description',
        'ass_item_type',
        'ass_labour_expense',
        'ass_material_expense',
    ];

    public $timestamps = true;

}
