<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranches extends Model
{
    use HasFactory;

    protected $table = 'company_branches';

    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'company_id',
        'branch_name',
        'branch_address',
        'branch_city',
        'branch_state',
        'branch_zip_code',
        'branch_email',
        'branch_phone',
    ];

    public $timestamps = true;

}
