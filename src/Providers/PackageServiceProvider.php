<?php

namespace MaciejInformatyka63\PackageGeo\Providers;

use Illuminate\Support\ServiceProvider;
use MaciejInformatyka63\PackageGeo\Console\Commands\ShowCountries;

final class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [
                    ShowCountries::class,
                ],
            );
        }
    }
}
