<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    // Estimate.php

    public function images()
    {
        return $this->hasMany(EstimateImage::class, 'estimate_id');
    }


    protected $table = 'estimates';

    protected $primaryKey = 'estimate_id';

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'edited_by',
        'estimate_status',
        'estimate_assigned',
        'estimate_assigned_to',
        'estimated_completed_by',
        'estimated_complete_date',
        'estimate_total',
    ];

    public $timestamps = true;
}
