<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeightPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'region_id',
        'weight_option_id',
        'user_id',
        'credit',
    ];
}
