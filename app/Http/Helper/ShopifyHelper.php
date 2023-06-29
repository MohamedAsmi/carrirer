<?php

namespace App\Http\Helper;

use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ShopifyHelper
{
    public static function getBaseUrl()
    {
        return User::getUserSettingByKey("STORE_URL", Setting::CONF_SHOPIFY_SETTING);
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
