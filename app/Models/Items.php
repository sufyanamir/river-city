<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_ids');
    }

    public function assemblies()
    {
        return $this->hasMany(ItemAssembly::class, 'item_id', 'item_id');
    }

    protected $table = 'items';

    protected $primaryKey =  'item_id';

    protected $fillable = [
        'item_name',
        'item_type',
        'item_units',
        'item_cost',
        'item_price',
        'labour_expense',
        'material_expense',
        'item_description',
        'group_ids',
    ];

    public $timestamps = true;
}
