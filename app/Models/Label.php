<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'name',
        'mobile',
        'email',
        'refrence',
        'address1',
        'address2',
        'address3',
        'street',
        'postcode',
        'city',
        'rigion',
        'service_id',
    ];
    static function findById($id){
        $Label= self::Where('id',$id)->first();
        return $Label;
    }
}
