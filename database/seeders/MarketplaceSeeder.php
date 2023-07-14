<?php

namespace Database\Seeders;

use App\Models\Marketplace;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create parent settings
        $marketplaces = [
            [
                'name' => 'Shopify',
                'slug' => 'shopify',
                'parent_setting_id' => Setting::getSettingByKey(Setting::CONF_SHOPIFY_SETTING)->id,
                'logo' => '',
            ]
        ];

        foreach ($marketplaces as $marketplace) {
            Marketplace::create($marketplace);
        }
    }
}
