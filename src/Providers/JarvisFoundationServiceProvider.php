<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Hechoenlaravel\JarvisFoundation\Menu\MenuService;
use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * Class JarvisFoundationServiceProvider
 * @package Hechoenlaravel\JarvisFoundation\Providers
 */
class JarvisFoundationServiceProvider extends ServiceProvider
{

    /**
     * Service providers to load
     * @var array
     */
    protected $providers = [
        \Hechoenlaravel\JarvisPlatformUi\Providers\JarvisPlatformUiServiceProvider::class,
        \Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\FieldsServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\EventServiceProvider::class,
        \Styde\Html\HtmlServiceProvider::class,
        \Nwidart\Modules\LaravelModulesServiceProvider::class,
        \Spatie\Permission\PermissionServiceProvider::class,
        \Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,
        \UxWeb\SweetAlert\SweetAlertServiceProvider::class,
        \Yajra\Datatables\DatatablesServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\ViewComposersServiceProvider::class,
        \Maatwebsite\Excel\ExcelServiceProvider::class,
        \Joselfonseca\LaravelApiTools\Providers\LaravelApiToolsServiceProvider::class,
        \Intervention\Image\ImageServiceProvider::class,
        \Yajra\Datatables\HtmlServiceProvider::class,
        \Spatie\Backup\BackupServiceProvider::class,
        \Sentry\SentryLaravel\SentryLaravelServiceProvider::class,
        \Hechoenlaravel\JarvisMenus\MenusServiceProvider::class
    ];

    /**
     * @var array
     */
    protected $aliases = [
        'Module' => \Nwidart\Modules\Facades\Module::class,
        'Uuid' => \Webpatser\Uuid\Uuid::class,
        'SweetAlert' => \UxWeb\SweetAlert\SweetAlert::class,
        'Datatables' => \Yajra\Datatables\Datatables::class,
        'Excel' => \Maatwebsite\Excel\Facades\Excel::class,
        'Sentry' => \Sentry\SentryLaravel\SentryFacade::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../resources/assets' => public_path('vendor/jplatform'),
        ], 'public');
        $this->registerMenus();
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
        $this->loadRoutes();
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

    /**
     * @return $this
     */
    protected function registerMenus()
    {
        if(!app('menu')->instance('sidebar')) {
            app('menu')->create('sidebar', function ($menu) {
                $menu->enableOrdering();
            });
            $this->app->singleton('menu.service', function(){
                return new MenuService();
            });
        }
    }
}
