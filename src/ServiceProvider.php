<?php

namespace Llama\Angular2;

use Llama\Angular2\Providers\BootstrapServiceProvider;
use Llama\Angular2\Providers\ConsoleServiceProvider;
use Llama\Angular2\Providers\ContractsServiceProvider;
use Llama\Angular2\Support\Stub;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Booting the package.
     */
    public function boot()
    {
        $this->registerNamespaces();

        $this->registerModules();
    }

    /**
     * Register all angular2.
     */
    protected function registerModules()
    {
        $this->app->register(BootstrapServiceProvider::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerServices();
        $this->setupStubPath();
        $this->registerProviders();
    }

    /**
     * Setup stub path.
     */
    public function setupStubPath()
    {
        $this->app->booted(function ($app) {
            Stub::setBasePath(__DIR__ . '/Commands/stubs');

            if ($app['angular2']->config('stubs.enabled') === true) {
                Stub::setBasePath($app['angular2']->config('stubs.path'));
            }
        });
    }

    /**
     * Register package's namespaces.
     */
    protected function registerNamespaces()
    {
        $configPath = __DIR__ . '/../config/config.php';
        $this->mergeConfigFrom($configPath, 'angular2');
        $this->publishes([
            $configPath => config_path('angular2.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     */
    protected function registerServices()
    {
        $this->app->singleton('angular2', function ($app) {
            $path = $app['config']->get('angular2.path');

            return new Repository($app, $path);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['angular2'];
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {
        $this->app->register(ConsoleServiceProvider::class);
        $this->app->register(ContractsServiceProvider::class);
    }
}
