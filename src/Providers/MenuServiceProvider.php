<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use MenuPing;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!MenuPing::instance('sidebar')) {
            MenuPing::create('sidebar', function ($menu) {
                $menu->enableOrdering();
                $menu->setPresenter('Hechoenlaravel\JarvisFoundation\Menu\Presenters\SidebarMenuPresenter');
            });
        }
        if (!MenuPing::instance('topnav')) {
            MenuPing::create('topnav', function ($menu) {
                $menu->enableOrdering();
            });
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
