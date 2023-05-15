<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weightprice extends Model
{
    use HasFactory;
    protected $fillable = [
        'region_id',
        'weightoption_id',
        'credits'
    ];
}
