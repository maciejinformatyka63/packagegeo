<?php

namespace Www\PackageGeo\Providers;

use Illuminate\Support\ServiceProvider;
use Www\PackageGeo\Console\Commands\ShowCountries;

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
