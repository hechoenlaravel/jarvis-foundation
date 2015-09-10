<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\FieldGenerator;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;

/**
 * Class TestEntityGenerator
 * @package Hechoenlaravel\JarvisFoundation\Tests\EntityGenerator
 */
class TestFieldGenerator extends TestCase
{

    /**
     *
     */
    public function test_it_gets_the_field_generator_command()
    {
        $FieldCreatorCommand = app('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand');
        $this->assertInstanceOf('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            $FieldCreatorCommand);
    }

    public function test_it_validates_field_type_is_valid()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        try {
            $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
                'entity_id' => $this->getAnEntity()->id,
                'namespace' => 'jarvis',
                'name' => 'first name',
                'description' => 'field Description',
                'slug' => 'first_name',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'fields.text'
            ], [
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator'
            ]);
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->assertTrue(false);
        }
    }

}