<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceOrder extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'marketplace_id', 'mp_order_id', 'products'];

    public static function checkOrderExistByMpOrderId($mpOrderId)
    {
        return self::where('mp_order_id', $mpOrderId)->exists();
    }
}
