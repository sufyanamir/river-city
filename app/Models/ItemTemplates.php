<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTemplates extends Model
{
    use HasFactory;

    protected $table = 'item_templates';

    protected $primaryKey = 'item_template_id';

    protected $fillable = [
        'added_user_id',
        'item_template_name',
        'description',
        'note',
    ];

    public $timestamps = true;

}
