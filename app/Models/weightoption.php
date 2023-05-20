<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
    ];

    public function weightPrice()
    {
        return $this->hasMany(WeightPrice::class);
    }

    public function delete()
    {
        if ($this->weightPrice()->exists()) {
            throw new \Exception('This weight option cannot be deleted since it has weight prices');
        }
        return parent::delete();
    }
}
