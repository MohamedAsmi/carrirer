<?php

namespace App\Http\Helper;

use App\Http\Service\UserService;
use App\Models\Marketplace;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MarketplaceHelper
{
    public static function getMarketplaceLogoById($marketplaceId)
    {
        $cacheKey = 'marketplace_logo_' . $marketplaceId;

        return Cache::remember($cacheKey, $minutes = 60, function () use ($marketplaceId) {
            $marketplaceSlug = Marketplace::find($marketplaceId)->value('slug');

            if ($marketplaceSlug) {
                return asset('marketplace-logos/' . $marketplaceSlug . '.png');
            }

            return asset('marketplace-logos/default.png');
        });
    }

    public static function getMarketplaceIdBySlug($marketplaceSlug)
    {
        $cacheKey = 'marketplace_id_for_' . $marketplaceSlug;

        return Cache::rememberForever($cacheKey, function () use ($marketplaceSlug) {
            return Marketplace::where('slug', $marketplaceSlug)->pluck('id')->first();
        });
    }
}
