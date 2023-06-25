<?php

namespace App\Http\Controllers\Marketplace;

use App\Http\Controllers\Controller;
use App\Http\Helper\ShopifyHelper;
use Illuminate\Http\Request;

class ShopifyController extends Controller
{
    public function setup()
    {
        $endpoint = ShopifyHelper::getShopifyInstallUrlForStore();
        return redirect($endpoint);
        // dd(config('marketplace'));
    }
    
    public function fetchOrder()
    {
        // $endpoint = ShopifyHelper::getShopifyUrlForStore();
        dd(config('marketplace'));
    }
}
