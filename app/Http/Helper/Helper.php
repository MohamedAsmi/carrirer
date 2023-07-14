<?php

namespace App\Http\Helper;

use App\Http\Helper\Service\UserService;
use App\Models\Marketplace;
use App\Models\Setting;

class Helper
{
    public static function getMarketplaceSettings($marketplaceId)
    {
        $userId = auth()->id();
        $parentSettingId = Marketplace::find($marketplaceId)->parent_setting_id;
        return UserService::getUserSettings($userId, $parentSettingId, true);
    }

    /**
     * Extracts the domain from a URL and strips off any other parts.
     *
     * @param string $url The input URL.
     * @return string The stripped domain or an empty string if the URL is invalid.
     */
    public static function stripToDomain($url)
    {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['host'])) {
            return $parsedUrl['host'];
        }
        return '';
    }
}
