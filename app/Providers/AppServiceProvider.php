<?php

namespace App\Providers;

use App\Http\Service\CustomerAddressService;
use App\Http\Service\LabelService;
use App\Http\Service\MarketplaceConfigService;
use App\Http\Service\OrderService;
use App\Http\Service\RegionService;
use App\Http\Service\SettingService;
use App\Http\Service\UserService;
use App\Http\Service\UserWeightPriceService;
use App\Services\ShopifyService;
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
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService();
        });
        $this->app->bind(LabelService::class, function ($app) {
            return new LabelService();
        });
        $this->app->bind(CustomerAddressService::class, function ($app) {
            return new CustomerAddressService();
        });
        $this->app->bind(ShopifyService::class, function ($app) {
            return new ShopifyService();
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
