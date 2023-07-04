<?php

namespace App\Helper;

use App\Http\Helper\MarketplaceHelper;
use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ShopifyHelper
{
    public static function getStoreBaseUrl($userId)
    {
        $storeDomain = User::getUserSettingByKey($userId, "STORE_URL", Setting::CONF_SHOPIFY_SETTING);
        return 'https://' . $storeDomain;
    }
    public static function getStoreAccessToken($userId)
    {
        return User::getUserSettingByKey($userId, "STORE_ACCESS_TOKEN", Setting::CONF_SHOPIFY_SETTING);
    }

    public static function validateRequestFromShopify($request)
    {
        try {
            $calculatedHmac = hash_hmac('sha256', http_build_query($request->except('hmac')), config('marketplace.shopify.client_secret'));
            if ($calculatedHmac !== $request->hmac) {
                throw ValidationException::withMessages([
                    'hmac' => 'Invalid HMAC signature',
                ]);
            }
            return true;
        } catch (Exception $e) {
            Log::info('Problem with verify hmac from request');
            Log::info($e->getMessage() . ' ' . $e->getLine());
            return false;
        }
    }

    public static function getFormattedOrder($order)
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

    public static function getFormattedAddress($order)
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
