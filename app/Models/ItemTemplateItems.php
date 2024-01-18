<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTemplateItems extends Model
{
    use HasFactory;

    protected $table = 'item_template_items';

    protected $primaryKey = 'it_item_id';

    protected $fillable = [
        'item_template_id',
        'item_id',
        'item_qty',
    ];

    public $timestamps = true;

}
