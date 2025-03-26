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

    public function invoices()
    {
        return $this->hasMany(AssignPayment::class, 'estimate_id');
    }

    public function estimateSchedule()
    {
        return $this->hasOne(EstimateSchedule::class, 'estimate_id');
    }

    public function estimateFiles()
    {
        return $this->hasMany(EstimateFile::class, 'estimate_id');
    }

    public function estimateNotes()
    {
        return $this->hasMany(EstimateNote::class, 'estimate_id');
    }

    public function estimateEmails()
    {
        return $this->hasMany(EstimateEmail::class, 'estimate_id');
    }

    public function estimateContacts()
    {
        return $this->hasMany(EstimateContact::class, 'estimate_id');
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
        'po_number',
        'percentage_discount',
        'price_discount',
        'discounted_total',
        'estimate_internal_note',
    ];

    public $timestamps = true;
}
