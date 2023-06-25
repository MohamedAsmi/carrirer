<?php

namespace App\Http\Helper;

use App\Models\Setting;

class ShopifyHelper
{
    public static function getShopifyInstallUrlForStore()
    {
        $store = "bytewavestore";
        $apiKey = config('marketplace.shopify_api.client_id');
        $scope = "read_orders";
        $redirect_url = url('/api/auth/shopify');
        return "https://$store.myshopify.com/admin/oauth/authorize?client_id=$apiKey&scope=$scope&redirect_url=$redirect_url";
    }
}
