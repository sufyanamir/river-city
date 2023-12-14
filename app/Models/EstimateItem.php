<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    use HasFactory;

    protected $table = 'estimate_items';

    protected $primaryKey = 'estimate_item_id';

    protected $fiillable = [
        'added_user_id',
        'estimate_id',
        'item_name',
        'item_type',
        'item_units',
        'item_cost',
        'item_price',
    ];

    public $timestamps = true;

}
