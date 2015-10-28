<?php

namespace Hechoenlaravel\JarvisFoundation\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Hechoenlaravel\JarvisFoundation\Tests\Stubs\UserModel;

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
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        $app['config']->set('jwt.user', 'Hechoenlaravel\JarvisFoundation\Tests\Stubs\UserModel');
    }

    /**
     * Migrate a SQL lite Database to test the package
     */
    protected function migrateDatabase()
    {
        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/migrations'),
        ]);
    }

    protected function createUser()
    {
        UserModel::create([
            'name' => 'test User',
            'email' => 'someuser@example.com',
            'password' => '123456789',
            'uuid' => '74927348972398472398'
        ]);
    }

    /**
     * Creates an entity for testing purposes
     * @return mixed
     */
    protected function getAnEntity()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');

        $bus->addHandler('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler\EntityGeneratorHandler');

        $return = $bus->dispatch('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand', [
            'namespace' => 'jarvis',
            'name' => 'entity name',
            'description' => 'Entity Description',
            'slug' => 'entity_name',
            'locked' => 1
        ], [
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\SetPrefixAndTableName'
        ]);
        return $return;
    }

    /**
     * Creates some fields for testing purposes
     * @param $entity
     * @return bool
     */
    protected function setSomeFields($entity)
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $fields = [
            [
                'entity_id' => $entity->id,
                'name' => 'first name',
                'description' => 'field Description',
                'slug' => 'first_name',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'text',
                'default' => 'defaultOne',
                'options' => [
                    'foo' => 'bar'
                ],
                'order' => 1
            ],
            [
                'entity_id' => $entity->id,
                'name' => 'last name',
                'description' => 'field Description',
                'slug' => 'last_name',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'text',
                'options' => [
                    'foo' => 'bar'
                ],
                'order' => 2
            ]
        ];
        $fieldsGenerated = [];
        foreach($fields as $field)
        {
            $fieldsGenerated[] = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', $field, [
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
            ]);
        }
        return $fieldsGenerated;
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