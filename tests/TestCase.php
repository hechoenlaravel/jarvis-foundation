<?php

namespace Hechoenlaravel\JarvisFoundation\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Class TestCase
 * @package Hechoenlaravel\Foundation\Tests
 */
class TestCase extends Orchestra{

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Hechoenlaravel\JarvisFoundation\Providers\JarvisFoundationServiceProvider'];
    }

    /**
     * it Just assert true so phpunit don't cry
     * with this class not having any tests
     */
    public function test_it_asserts_true()
    {
        $this->assertTrue(true);
    }

}