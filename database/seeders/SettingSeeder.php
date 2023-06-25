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
                'application_level' => true,
                // 'non_removable' => true,
            ],
            [
                'key' => Setting::CONF_SYS_SHOPIFY_SETTING,
                'value' => 'Shopify Setting',
                'parent_id' => null,
                'application_level' => true,
                // 'non_removable' => true,
            ],
        ];

        foreach ($parentSettings as $parentSetting) {
            Setting::create($parentSetting);
        }

        // Create child settings
        $childSettings = [
            [
                'key' => 'CLIENT_ID',
                'value' => 'Client ID',
                'parent_id' => Setting::where('key', Setting::CONF_SYS_SHOPIFY_SETTING)->value('id'),
                'application_level' => true,
                // 'non_removable' => true,
            ],
            [
                'key' => 'CLIENT_SECRET',
                'value' => 'Client Secret',
                'parent_id' => Setting::where('key', Setting::CONF_SYS_SHOPIFY_SETTING)->value('id'),
                'application_level' => true,
                // 'non_removable' => true,
            ],
        ];

        foreach ($childSettings as $childSetting) {
            Setting::create($childSetting);
        }
    }
}
