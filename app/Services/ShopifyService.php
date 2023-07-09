<?php

namespace App\Services;

use App\Helper\ShopifyHelper;
use App\Http\Helper\MarketplaceHelper;
use App\Services\Api\ShopifyAPI;
use Exception;

class ShopifyService
{
    public function __construct()
    {
    }

    public function syncOrder($user, $orderService, $customerAddressService)
    {
        try {
            $userId = $user->id;
            $orders = $this->fetchOrders($userId);

            foreach ($orders as $order) {
                $formattedOrder = $this->getFormattedOrder($order);
                $formattedOrder['user_id'] = $userId;
                $orderId = $orderService->createOrder($formattedOrder);

                if (isset($order['shipping_address'])) {
                    $shippingAddress = $order['shipping_address'];
                    $formattedAddress = $this->getFormattedAddress($shippingAddress);
                    $formattedAddress['order_id'] = $orderId;
                    $customerAddressService->createAddress($formattedAddress);
                }
            }
        } catch (Exception $e) {
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

    private function getFormattedOrder($order)
    {
        $orderData = [];
        $orderData['marketplace_id'] = MarketplaceHelper::getMarketplaceIdBySlug('shopify');
        $orderData['mp_order_id'] = $order['id'];

        $products = [];
        $i = 0;
        foreach ($order['line_items'] as $line_item) {
            $products[$i]['name'] = $line_item['name'];
            $products[$i]['quantity'] = $line_item['quantity'];
            $i++;
        }
        $orderData['products'] = serialize($products);

        return $orderData;
    }

    private function getFormattedAddress($order)
    {
        $shippingAddress = [];
        $shippingAddress['first_name'] = $order['first_name'];
        $shippingAddress['last_name'] = $order['last_name'];
        $shippingAddress['company'] = $order['company'] ?? null;
        $shippingAddress['phone'] = $order['phone'] ?? null;
        $shippingAddress['address_line_1'] = $order['address1'] ?? null;
        $shippingAddress['address_line_2'] = $order['address2'] ?? null;
        $shippingAddress['address_line_3'] = $order['address3'] ?? null;
        $shippingAddress['city'] = $order['city'];
        $shippingAddress['zip'] = $order['zip'] ?? null;
        $shippingAddress['province'] = $order['province'] ?? null;
        $shippingAddress['country'] = $order['country'];
        $shippingAddress['country_code'] = $order['country_code'];
        return $shippingAddress;
    }
}
