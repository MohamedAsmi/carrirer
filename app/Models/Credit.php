<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Credit extends Model
{
    use HasFactory;
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
