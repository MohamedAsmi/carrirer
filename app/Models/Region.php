<?php

namespace App\Models;

use App\Http\Helper\ResponseHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    use ResponseHelper;

    protected $fillable = [
        'code',
        'name',
    ];

    public function weightPrice(){
        return $this->hasMany(WeightPrice::class);
    }

    public function delete()
    {
        if($this->weightPrice()->exists()){
            throw new \Exception('This region cannot be deleted since it has weight prices');
        }
        return parent::delete();
    }
}
