<?php

namespace App\Jobs\Sync;

use App\Helper\ShopifyHelper;
use App\Http\Helper\Service\CustomerAddressService;
use App\Http\Helper\Service\OrderService;
use App\Services\ShopifyAPI;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SyncShopifyOrders implements ShouldQueue
{
    private $user;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        OrderService $orderService,
        CustomerAddressService $customerAddress
    ) {
        try {
            $userId = $this->user->id;
            $orders = $this->fetchOrders($userId);

            foreach ($orders as $order) {
                $formattedOrder = ShopifyHelper::getFormattedOrder($order);
                $formattedOrder['user_id'] = $userId;
                $orderId = $orderService->createOrder($formattedOrder);

                if (isset($order['shipping_address'])) {
                    $shippingAddress = $order['shipping_address'];
                    $formattedAddress = ShopifyHelper::getFormattedAddress($shippingAddress);
                    $formattedAddress['order_id'] = $orderId;
                    $customerAddress->createAddress($formattedAddress);
                }
            }
        } catch (Exception $e) {
            Log::critical(['code' => $e->getCode(), 'message' => $e->getMessage(), 'trace' => json_encode($e->getTrace())]);
            throw $e;
        }
    }

    private function fetchOrders($userId)
    {
        $baseUrl = ShopifyHelper::getStoreBaseUrl($userId);
        $accessToken = ShopifyHelper::getStoreAccessToken($userId);
        $shopifyApi = new ShopifyAPI($baseUrl);
        $shopifyApi->setAccessToken($accessToken);
        return $shopifyApi->getOrders();
    }
}
