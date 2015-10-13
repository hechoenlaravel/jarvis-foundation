<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Illuminate\Support\ServiceProvider;

class JarvisFoundationServiceProvider extends ServiceProvider{

    /**
     * Service providers to load
     * @var array
     */
    protected $providers = [
        \Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\FieldsServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\EventServiceProvider::class,
        \Styde\Html\HtmlServiceProvider::class,
        \Joselfonseca\LaravelApiTools\LaravelApiToolsServiceProvider::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutes();
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('vendor/jplatform'),
        ], 'public');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerOtherProviders();
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'jarvisPlatform');
    }

    /**
     * Register other Service Providers
     * @return $this
     */
    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
        return $this;
    }

    /**
     * @return $this
     */
    protected function loadRoutes()
    {
        require_once __DIR__.'/../Http/routes.php';
        return $this;
    }
}