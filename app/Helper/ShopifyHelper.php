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
        if($storeDomain == null)
            throw new Exception("Error: Shopify Store URL not found. Please ensure your store URL is correctly configured and try connecting again.");
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
}
