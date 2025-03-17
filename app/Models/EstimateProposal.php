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
        'proposal_data',
        'proposal_terms_and_conditions',
        'proposal_type',
        'group_id',
    ];

    public $timestamps = true;

}
