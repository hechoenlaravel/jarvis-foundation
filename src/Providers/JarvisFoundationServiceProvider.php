<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Illuminate\Support\ServiceProvider;

class JarvisFoundationServiceProvider extends ServiceProvider{

    protected $providers = [
        \Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider::class,
        \Pingpong\Modules\ModulesServiceProvider::class,
        \Prettus\Repository\Providers\RepositoryServiceProvider::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: Implement register() method.
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerOtherProviders();
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
}