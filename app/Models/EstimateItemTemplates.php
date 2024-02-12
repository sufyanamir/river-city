<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateItemTemplates extends Model
{
    use HasFactory;

    protected $table = 'estimate_item_templates';

    protected $primaryKey = 'est_template_id';

    protected $fillable = [
        'added_user_id',
        'estimate_id',
        'item_template_id',
        'item_template_name',
        'description',
        'note',
        'template_status',
    ];

    public $timestamps = true;

}
