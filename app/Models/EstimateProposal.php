<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateProposal extends Model
{
    use HasFactory;

    protected $table = 'estimate_proposals';

    protected $primaryKey = 'estimate_proposal_id';

    protected $fillable = [
        'estimate_id',
        'proposal_total',
        'proposal_accepted',
        'proposal_status',
    ];

    public $timestamps = true;

}
