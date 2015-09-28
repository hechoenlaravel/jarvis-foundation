<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\FieldGenerator;

use Hechoenlaravel\JarvisFoundation\Exceptions\FieldTypeNotRegistered;
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
                'name' => 'first name',
                'description' => 'field Description',
                'slug' => 'first_name',
                'locked' => 1,
                'create_field' => 1,
                'type' => 'text'
            ], [
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            ]);
            $this->assertTrue(true);
        } catch (FieldTypeNotRegistered $e) {
            $this->assertTrue(false);
        }
    }

    /**
     * @expectedException Hechoenlaravel\JarvisFoundation\Exceptions\FieldTypeNotRegistered
     */
    public function test_it_validates_field_type_is_invalid()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $this->getAnEntity()->id,
            'name' => 'first name',
            'description' => 'field Description',
            'slug' => 'first_name',
            'locked' => 1,
            'create_field' => 1,
            'type' => 'someFieldType'
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator'
        ]);
    }

    /**
     * @expectedException Hechoenlaravel\JarvisFoundation\Exceptions\FieldValidationException
     */
    public function test_it_validates_field_to_add()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'locked' => 1,
            'create_field' => 1,
            'type' => 'text'
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator'
        ]);
    }

    public function test_it_creates_the_field_in_db()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'first name',
            'description' => 'field Description',
            'slug' => 'first_name',
            'locked' => 1,
            'create_field' => 1,
            'type' => 'text'
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
        ]);
        $this->seeInDatabase('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
    }

    public function test_it_creates_the_field_in_table()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'first name',
            'description' => 'field Description',
            'slug' => 'first_name',
            'locked' => 1,
            'create_field' => 1,
            'type' => 'text'
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
        ]);
        $this->seeInDatabase('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
        $this->assertTrue(\Schema::hasColumn($entity->getTableName(), 'first_name'));
    }

    public function test_it_does_not_creates_the_field_in_table_as_per_instruction()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'first name',
            'description' => 'field Description',
            'slug' => 'first_name',
            'locked' => 1,
            'create_field' => 0,
            'type' => 'text'
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
        ]);
        $this->seeInDatabase('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
        $this->assertFalse(\Schema::hasColumn($entity->getTableName(), 'first_name'));
    }

}