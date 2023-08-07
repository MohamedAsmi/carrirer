<?php

namespace App\Http\Service;

use App\Models\Marketplace;
use App\Models\MarketplaceOrder;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;


class OrderService
{

    public function createOrder($order = array())
    {
        try {
                $order = MarketplaceOrder::create($order);
                return $order->id;
        } catch (Exception $e) {
            Log::critical(['code' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => json_encode($e->getTrace())]);
            throw $e;
        }
    }
}
