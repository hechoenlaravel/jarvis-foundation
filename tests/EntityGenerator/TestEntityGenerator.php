<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\EntityGenerator;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;

/**
 * Class TestEntityGenerator
 * @package Hechoenlaravel\JarvisFoundation\Tests\EntityGenerator
 */
class TestEntityGenerator extends TestCase
{

    /**
     *
     */
    public function test_it_gets_the_entity_creator_command()
    {
        $EntityCreatorCommand = app('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand');
        $this->assertInstanceOf('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand', $EntityCreatorCommand);
    }

    /**
     * @expectedException     Hechoenlaravel\JarvisFoundation\Exceptions\CommandValidationException
     */
    public function test_it_validates_the_command()
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler\EntityGeneratorHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand', [], [
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\SetPrefixAndTableName'
        ]);
    }

    /**
     *
     */
    public function test_it_creates_the_entity_in_the_db()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');

        $bus->addHandler('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler\EntityGeneratorHandler');

        $entity = $bus->dispatch('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand', [
            'namespace' => 'jarvis',
            'name' => 'entity name',
            'description' => 'Entity Description',
            'slug' => 'entity_name',
            'locked' => 1
        ], [
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\SetPrefixAndTableName'
        ]);

        $this->assertInstanceOf('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel', $entity);
        $this->assertEquals('entity name', $entity->name);
    }

    public function test_it_creates_the_table_in_the_db()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');

        $bus->addHandler('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler\EntityGeneratorHandler');

        $bus->dispatch('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand', [
            'namespace' => 'jarvis',
            'name' => 'entity name',
            'description' => 'Entity Description',
            'slug' => 'entity_name',
            'locked' => 1
        ], [
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\SetPrefixAndTableName'
        ]);

        $this->assertTrue(\Schema::hasTable('jarvis_entity_name'));
    }

    public function test_it_should_not_create_a_database_table()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');

        $bus->addHandler('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler\EntityGeneratorHandler');

        $bus->dispatch('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand', [
            'namespace' => 'jarvis',
            'name' => 'entity name 2',
            'description' => 'Entity Description',
            'slug' => 'entity_name_2',
            'locked' => 1,
            'create_table' => 0
        ], [
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\SetPrefixAndTableName'
        ]);
        $this->seeInDatabase('app_entities', ['slug' => 'entity_name_2']);
        $this->assertFalse(\Schema::hasTable('jarvis_entity_name_2'));
    }

}