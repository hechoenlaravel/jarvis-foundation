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
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator'
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
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator'
        ]);

        $this->assertInstanceOf('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel', $entity);
        $this->assertEquals('entity name', $entity->name);
    }

}