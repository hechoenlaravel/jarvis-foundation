<?php

namespace Hechoenlaravel\JarvisFoundation\Tests;


/**
 * Class ServiceProvider
 * @package Hechoenlaravel\JarvisFoundation\Tests
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     *
     */
    public function boot()
    {
        $this->loadMigrationsFrom(realpath(__DIR__.'/../tests/migrations'));
    }

    /**
     *
     */
    public function register()
    {

    }
}