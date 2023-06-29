<?php

namespace App\Providers;

use App\Http\Helper\Service\MarketplaceConfigService;
use App\Http\Helper\Service\RegionService;
use App\Http\Helper\Service\SettingService;
use App\Http\Helper\Service\UserService;
use App\Http\Helper\Service\UserWeightPriceService;
use App\Services\ShopifyAPI;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->bind(RegionService::class, function ($app) {
            return new RegionService();
        });
        $this->app->bind(SettingService::class, function ($app) {
            return new SettingService();
        });
        $this->app->bind(UserWeightPriceService::class, function ($app) {
            return new UserWeightPriceService();
        });
        $this->app->bind(MarketplaceConfigService::class, function ($app) {
            return new MarketplaceConfigService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
