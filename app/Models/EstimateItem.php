<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    use HasFactory;

    public function group()
    {
        // First try to get estimate-specific group, fallback to global group
        if ($this->estimate_group_id) {
            return $this->belongsTo(EstimateGroups::class, 'estimate_group_id');
        }
        return $this->belongsTo(Groups::class, 'group_id');
    }

    public function estimateGroup()
    {
        return $this->belongsTo(EstimateGroups::class, 'estimate_group_id');
    }

    public function globalGroup()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }

    public function assemblies()
    {
        return $this->hasMany(EstimateItemAssembly::class, 'estimate_item_id');
    }

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
        'is_upgrade',
        'upgrade_status',
        'item_status',
        'group_id',
        'estimate_group_id',
        'additional_item',
    ];

    public $timestamps = true;

}
