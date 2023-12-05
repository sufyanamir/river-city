<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAssembly extends Model
{
    use HasFactory;

    public function item()
    {
        return  $this->belongsTo(Items::class, 'item_id', 'item_id');
    }

    protected $table = 'item_assemblies';

    protected $primaryKey = 'assembly_id';

    protected $fillable = [
        'item_id',
        'assembly_name',
    ];

    public $timestamps = true;
}
