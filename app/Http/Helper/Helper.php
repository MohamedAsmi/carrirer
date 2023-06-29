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
        return UserService::getUserSettings($userId, $parentSettingId);
    }
}
