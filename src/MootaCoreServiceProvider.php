<?php

namespace Otnansirk\Moota;

use Illuminate\Support\ServiceProvider;
use Otnansirk\Moota\Services\MootaPayService;
use Otnansirk\Moota\Services\MootaTagService;
use Otnansirk\Moota\Services\MootaAuthService;
use Otnansirk\Moota\Services\MootaBankService;
use Otnansirk\Moota\Services\MootaCoreService;
use Otnansirk\Moota\Services\MootaTopupService;
use Otnansirk\Moota\Services\MootaMutationService;

class MootaCoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MootaCore', MootaCoreService::class);
        $this->app->bind('MootaPay', MootaPayService::class);
        $this->app->bind('MootaAuth', MootaAuthService::class);
        $this->app->bind('MootaBank', MootaBankService::class);
        $this->app->bind('MootaMutation', MootaMutationService::class);
        $this->app->bind('MootaTag', MootaTagService::class);
        $this->app->bind('MootaTopup', MootaTopupService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'otnansirk/laravel-moota');
        $this->publishes([
            __DIR__.'/../config/moota.php' => config_path('moota.php'),
        ]);
    }
}
