<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(Items::class, 'group_ids');
    }

    protected $table = 'groups';

    protected $primaryKey = 'group_id';

    protected $fillable = [
        'group_name',
        'group_items',
        'total_items',
        'group_type',
        'group_description',
        'show_unit_price',
        'show_quantity',
        'show_total',
    ];

    public $timestamps = true;
}
