<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Hechoenlaravel\JarvisFoundation\Auth\AppAuthenticationProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class JarvisFoundationServiceProvider extends ServiceProvider
{
    /**
     * Service providers to load
     * @var array
     */
    protected $providers = [
        \Pingpong\Generators\GeneratorsServiceProvider::class,
        \Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\FieldsServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\EventServiceProvider::class,
        \Styde\Html\HtmlServiceProvider::class,
        \Joselfonseca\LaravelApiTools\LaravelApiToolsServiceProvider::class,
        \Pingpong\Menus\MenusServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\MenuServiceProvider::class,
        \Pingpong\Widget\WidgetServiceProvider::class,
        \Pingpong\Modules\ModulesServiceProvider::class,
        \Barryvdh\Debugbar\ServiceProvider::class,
        \Baum\Providers\BaumServiceProvider::class,
        \Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,
        \UxWeb\SweetAlert\SweetAlertServiceProvider::class,
        \yajra\Datatables\DatatablesServiceProvider::class,
        \Joselfonseca\ImageManager\ImageManagerServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\ViewComposersServiceProvider::class,

    ];

    protected $aliases = [
        'MenuPing' => \Pingpong\Menus\MenuFacade::class,
        'Module' => \Pingpong\Modules\Facades\Module::class,
        'Widget' => \Pingpong\Widget\WidgetFacade::class,
        'Debugbar' => \Barryvdh\Debugbar\Facade::class,
        'Uuid' => \Webpatser\Uuid\Uuid::class,
        'SweetAlert' => \UxWeb\SweetAlert\SweetAlert::class,
        'Datatables' => \yajra\Datatables\Datatables::class,
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
        app('Dingo\Api\Auth\Auth')->extend('inSession', function ($app) {
            return app('jarvis.auth.provider');
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerOtherProviders()->registerAliases();
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'jarvisPlatform');
        $this->app->bind('jarvis.auth.provider', AppAuthenticationProvider::class);
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
     * Register some Aliases
     * @return $this
     */
    protected function registerAliases()
    {
        foreach ($this->aliases as $alias => $original) {
            AliasLoader::getInstance()->alias($alias, $original);
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
