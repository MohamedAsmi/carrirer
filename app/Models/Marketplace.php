<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_marketplaces')->withTimestamps();
    }
    
    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
