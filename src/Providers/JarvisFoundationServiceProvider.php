<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Spatie\Menu\Laravel\Menu;

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
        \Laracasts\Utilities\JavaScript\JavaScriptServiceProvider::class,
        \UxWeb\SweetAlert\SweetAlertServiceProvider::class,
        \Yajra\Datatables\DatatablesServiceProvider::class,
        \Hechoenlaravel\JarvisFoundation\Providers\ViewComposersServiceProvider::class,
        \Maatwebsite\Excel\ExcelServiceProvider::class,
        \Joselfonseca\LaravelApiTools\Providers\LaravelApiToolsServiceProvider::class,
        \Spatie\Permission\PermissionServiceProvider::class,
        \Intervention\Image\ImageServiceProvider::class,
        \Spatie\Menu\Laravel\MenuServiceProvider::class,
        \Yajra\Datatables\HtmlServiceProvider::class,
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
        $this->app->singleton('menu.sidebar', function() {
            return app(Menu::class)->addClass('sidebar-menu');
        });
        return $this;
    }
}
