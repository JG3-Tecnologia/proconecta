<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'demand_id',
        'type',
        'file_path',
    ];

    public function demand()
    {
        return $this->belongsTo(Demand::class);
    }
}