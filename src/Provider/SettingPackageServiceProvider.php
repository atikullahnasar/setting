<?php

namespace atikullahnasar\setting\Provider;

use atikullahnasar\setting\Repositories\CountryCityState\CountryCityStateRepository;
use atikullahnasar\setting\Repositories\CountryCityState\CountryCityStateRepositoryInterface;
use atikullahnasar\setting\Repositories\CustomPages\CustomPageRepository;
use atikullahnasar\setting\Repositories\CustomPages\CustomPageRepositoryInterface;
use atikullahnasar\setting\Repositories\Settings\SettingRepository;
use atikullahnasar\setting\Repositories\Settings\SettingRepositoryInterface;
use atikullahnasar\setting\Services\CustomPages\CustomPageService;
use atikullahnasar\setting\Services\CustomPages\CustomPageServiceInterface;
use atikullahnasar\setting\Services\Settings\SettingService;
use atikullahnasar\setting\Services\Settings\SettingServiceInterface;
use Illuminate\Support\ServiceProvider;

class SettingPackageServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'setting');

        // Publish migrations
        $this->publishes([
            __DIR__ . '/../Database/migrations' => database_path('migrations'),
        ], 'setting-migrations');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');

    }

    public function register()
    {
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
        $this->app->bind(CustomPageServiceInterface::class, CustomPageService::class);

        $this->app->bind(CustomPageRepositoryInterface::class, CustomPageRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(CountryCityStateRepositoryInterface::class, CountryCityStateRepository::class);
    }
}
