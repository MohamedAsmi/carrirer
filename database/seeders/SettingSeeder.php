<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Create parent settings
        $parentSettings = [
            [
                'key' => Setting::CONF_CSV_MAPPING,
                'value' => 'CSV Mapping',
                'parent_id' => null,
                'application_level' => false,
            ],
            [
                'key' => Setting::CONF_SHOPIFY_SETTING,
                'value' => 'Shopify Setting',
                'parent_id' => null,
                'application_level' => false,
            ],
        ];

        foreach ($parentSettings as $parentSetting) {
            Setting::create($parentSetting);
        }

        // Create child settings
        $childSettings = [
            [
                'key' => 'STORE_URL',
                'value' => 'Store URL',
                'parent_id' => Setting::where('key', Setting::CONF_SHOPIFY_SETTING)->value('id'),
                'application_level' => false,
            ],
            [
                'key' => 'STORE_ACCESS_TOKEN',
                'value' => 'Store Access Token',
                'parent_id' => Setting::where('key', Setting::CONF_SHOPIFY_SETTING)->value('id'),
                'application_level' => false,
            ],
        ];

        foreach ($childSettings as $childSetting) {
            Setting::create($childSetting);
        }
    }
}
