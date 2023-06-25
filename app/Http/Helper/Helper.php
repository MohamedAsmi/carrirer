<?php

namespace App\Http\Helper;

use App\Models\Setting;

class Helper {
    public static function getMarketplaceSettings(){
        $marketplaceConfigParents = Setting::getMarketplaceConfigParents();
        dd($marketplaceConfigParents);
        foreach($marketplaceConfigParents as $configParent){

        }
    }
}