<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'company',
        'phone',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'zip',
        'province',
        'country',
        'country_code',
    ];
}
