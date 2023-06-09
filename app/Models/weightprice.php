<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'region_id',
        'weight_option_id',
        'credits'
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function weightOption()
    {
        return $this->belongsTo(WeightOption::class);
    }
}
