<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Credit extends Model
{
    use HasFactory;
    const IS_ADMIN = 1;
    const IS_LABEL = 2;
    const IS_BATCH = 3;
    const IS_PAYPAL = 4;

    protected $fillable = [
        'credit_added',
        'credit_amount',
        'total',
        'source_id',
        'details',
        'addto',
        'addby'
    ];

    protected $casts = [
        'credit_added' => 'datetime',
    ];

    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->addby = Auth::user()->id;
        });
    }
}
