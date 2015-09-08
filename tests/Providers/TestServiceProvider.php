<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\Providers;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;


/**
 * Class TestServiceProvider
 * @package Hechoenlaravel\JarvisFoundation\Tests\Providers
 */
class TestServiceProvider extends TestCase
{

    /**
     * Test if the Service providers is being loaded by the app
     */
    public function test_it_loads_service_provider()
    {
        $this->assertInstanceOf('Hechoenlaravel\JarvisFoundation\Providers\JarvisFoundationServiceProvider',
            app()->getProvider('Hechoenlaravel\JarvisFoundation\Providers\JarvisFoundationServiceProvider'));
    }

    /**
     * Since the service provider is being loaded check if
     * the laravel Admin service provider was also loaded
     */
    public function test_it_loads_laravel_admin_service_provider()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider',
            app()->getProvider('Joselfonseca\LaravelAdmin\Providers\LaravelAdminServiceProvider'));
    }

    /**
     * Since the service provider is being loaded check if
     * the pingpong modules service provided was also loaded
     */
    public function test_it_loads_pingpong_service_provider()
    {
        $this->assertInstanceOf('Pingpong\Modules\ModulesServiceProvider',
            app()->getProvider('Pingpong\Modules\ModulesServiceProvider'));
    }

    /**
     * Since the service provider is being loaded check if
     * the repositories service provider was also loaded
     */
    public function test_it_loads_repositories_service_provider()
    {
        $this->assertInstanceOf('Prettus\Repository\Providers\RepositoryServiceProvider',
            app()->getProvider('Prettus\Repository\Providers\RepositoryServiceProvider'));
    }

    /**
     * Since the service provider is being loaded check if the
     * laravel tactician service provider was also loaded
     */
    public function test_it_loads_laravel_tactician_service_provider()
    {
        $this->assertInstanceOf('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider',
            app()->getProvider('Joselfonseca\LaravelTactician\Providers\LaravelTacticianServiceProvider'));
    }
}