<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateGroups extends Model
{
    use HasFactory;

    protected $table = 'estimate_groups';
    protected $primaryKey = 'estimate_group_id';

    protected $fillable = [
        'estimate_id',
        'group_name',
        'group_type',
        'group_description',
        'show_unit_price',
        'show_quantity',
        'show_total',
        'show_group_total',
        'include_est_total',
        'added_user_id',
    ];

    protected $casts = [
        'show_unit_price' => 'boolean',
        'show_quantity' => 'boolean',
        'show_total' => 'boolean',
        'show_group_total' => 'boolean',
        'include_est_total' => 'boolean',
    ];

    public function estimate()
    {
        return $this->belongsTo(Estimate::class, 'estimate_id');
    }

    public function addedUser()
    {
        return $this->belongsTo(User::class, 'added_user_id');
    }

    public function estimateItems()
    {
        return $this->hasMany(EstimateItem::class, 'estimate_group_id', 'estimate_group_id');
    }

    /**
     * Get or create an estimate group
     */
    public static function getOrCreate($estimateId, $groupName, $userId, $groupData = [])
    {
        $group = static::where('estimate_id', $estimateId)
            ->where('group_name', $groupName)
            ->first();

        if (!$group) {
            $defaultData = [
                'estimate_id' => $estimateId,
                'group_name' => $groupName,
                'group_type' => 'assemblies',
                'show_unit_price' => true,
                'show_quantity' => true,
                'show_total' => true,
                'show_group_total' => true,
                'include_est_total' => true,
                'added_user_id' => $userId,
            ];

            $group = static::create(array_merge($defaultData, $groupData));
        }

        return $group;
    }

    /**
     * Get all groups for a specific estimate
     */
    public static function getForEstimate($estimateId)
    {
        return static::where('estimate_id', $estimateId)->get();
    }

    /**
     * Get combined groups (estimate-specific + global) for an estimate
     */
    public static function getCombinedGroups($estimateId)
    {
        $estimateGroups = static::getForEstimate($estimateId);
        $globalGroups = Groups::all();
        
        // Mark estimate groups as estimate-specific
        foreach ($estimateGroups as $group) {
            $group->is_estimate_specific = true;
        }
        
        // Mark global groups as global
        foreach ($globalGroups as $group) {
            $group->is_estimate_specific = false;
        }
        
        return $estimateGroups->concat($globalGroups);
    }
}
