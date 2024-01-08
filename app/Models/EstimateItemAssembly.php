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
    ];

    public $timestamps = true;

}
