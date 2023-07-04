<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Helper\ShopifyHelper;
use App\Models\Setting;
use App\Models\User;
use App\Services\ShopifyAPI;
use Exception;
use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    protected $shopifyApi;

    public function __construct()
    {
    }
    public function setup()
    {
        $baseUrl = ShopifyHelper::getStoreBaseUrl(auth()->id());
        try{
            if (!empty($baseUrl)) {
                $redirectUri = route('marketplace.shopify.redirect');
                $authorizationUrl = (new ShopifyAPI($baseUrl))->getAuthorizationUrl($redirectUri);
                return redirect($authorizationUrl);
            }else{
                throw new Exception("Error: Shopify Store URL not found. Please ensure your store URL is correctly configured and try connecting again.");
            }
        }catch(Exception $e){
            return redirect()->route('marketplace.config.index')->with('error', $e->getMessage());
        }
    }

    public function handleRedirect(Request $request)
    {
        try {
            $isRequestValid = ShopifyHelper::validateRequestFromShopify($request);
            if ($isRequestValid) {
                $baseUrl = ShopifyHelper::getStoreBaseUrl(auth()->id());
                $shopifyApi = new ShopifyAPI($baseUrl);
                $accessToken = $shopifyApi->requestAccessToken($request->code);
                $user = User::find(auth()->id());

                $setting = Setting::getSettingByKey('STORE_ACCESS_TOKEN');
                $data = [
                    $setting->id => [
                        'value' => $accessToken,
                        'setting_parent_id' => $setting->parent_id
                    ]
                ];

                $user->settings()->syncWithoutDetaching($data);
                return redirect()->route('marketplace.config.index')->with('success', 'Success: Shopify connection established successfully!');
            }
        } catch (Exception $e) {
            return redirect()->route('marketplace.config.index')->with('error', $e->getMessage());
        }
    }

    public function fetchOrder()
    {
        //;
    }
}
