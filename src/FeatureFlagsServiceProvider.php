<?php

namespace Cidekar\FeatureFlags;

use Illuminate\Support\ServiceProvider;
use Cidekar\FeatureFlags\Http\Middleware\CheckForAnyFeatureFlag;
use Cidekar\FeatureFlags\Console\CreateCommand;
use Cidekar\FeatureFlags\Console\UpdateCommand;
use Cidekar\FeatureFlags\Console\DestroyCommand;

class FeatureFlagsServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/../database/migrations/') => database_path('migrations'),
        ], 'migrations');
        
        $this->loadMigrationsFrom(
            realpath(__DIR__.'/../database/migrations/')
        );
        
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateCommand::class,
                UpdateCommand::class,
                DestroyCommand::class,
            ]);
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['router']->aliasMiddleware('flags', CheckForAnyFeatureFlag::class);
    }
}
