<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $primaryKey = 'company_row_id';

    protected $fillable = [
        'company_labor_cost',
        'company_labor_budget',
        'company_material_budget',
    ];

    public $timestamps = true;

}
