<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    // Estimate.php

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function images()
    {
        return $this->hasMany(EstimateImages::class, 'estimate_id');
    }

    public function scheduler()
    {
        return $this->belongsTo(User::class, 'estimate_schedule_assigned_to');
    }

    public function assigned_work()
    {
        return $this->belongsTo(ScheduleEstimate::class, 'estimate_id');
    }

    public function crew()
    {
        return $this->belongsTo(User::class, 'work_assigned_to');
    }

    protected $table = 'estimates';

    protected $primaryKey = 'estimate_id';

    protected $fillable = [
        'customer_id',
        'added_user_id',
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
        'scheduled_start_date',
        'scheduled_end_date',
        'work_assigned',
        'customer_last_name',
        'tax_rate',
        'project_name',
        'project_number',
        'schedule_assigned',
        'schedule_assigned_to',
        'work_completed_by',
        'work_completed',
        'complete_work_date',
        'invoice_assigned',
        'invoice_assigned_to',
        'payment_assigned',
        'payment_assigned_to',
        'invoiced_payment',
        'invoice_paid',
        'invoice_paid_total',
        'estimate_schedule_assigned',
        'estimate_schedule_assigned_to',
        'building_type',
        'project_type',
        'project_owner',
        'customer_signature',
        'work_assigned_to',
    ];

    public $timestamps = true;
}
