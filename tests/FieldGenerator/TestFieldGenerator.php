<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\FieldGenerator;

use Hechoenlaravel\JarvisFoundation\Exceptions\FieldTypeNotRegistered;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
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
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
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
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
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
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
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
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
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
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
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
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->seeInDatabase('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
        $this->assertFalse(\Schema::hasColumn($entity->getTableName(), 'first_name'));
    }

    public function test_serializes_the_options_property()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'first name',
            'description' => 'field Description',
            'slug' => 'first_name',
            'locked' => 1,
            'create_field' => 0,
            'type' => 'text',
            'options' => [
                'foo' => 'bar'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->assertEquals(serialize(['foo' => 'bar']), $field->options);
    }

    public function test_order_the_fields()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'address',
            'description' => 'field Description',
            'slug' => 'address',
            'locked' => 1,
            'create_field' => 1,
            'type' => 'text',
            'options' => [
                'foo' => 'bar'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->assertEquals(3, $field->order);
    }

    public function test_order_the_fields_when_default_order_provided()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'address',
            'description' => 'field Description',
            'slug' => 'address',
            'locked' => 1,
            'create_field' => 1,
            'type' => 'text',
            'options' => [
                'foo' => 'bar'
            ],
            'order' => 1
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->assertEquals(1, $field->order);
        $this->seeInDatabase('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name', 'order' => 2]);
    }

    public function test_it_runs_the_pre_assign_event_on_field()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand', [
            'entity_id' => $entity->id,
            'name' => 'address',
            'description' => 'field Description',
            'slug' => 'address',
            'locked' => 1,
            'create_field' => 1,
            'type' => 'slug',
            'options' => [
                'field' => 'first_name'
            ],
            'order' => 1
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $f = unserialize($field->options);
        $this->assertEquals('-', $f['separator']);
    }

    public function test_it_edits_a_field()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\EditFieldGeneratorHandler');
        $entity = $this->getAnEntity();
        $fields = $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldGeneratorCommand', [
            'id' => $fields[0]->id,
            'name' => 'address',
            'description' => 'field Description',
            'default' => 'defaultTwo',
            'required' => $fields[0]->required,
            'options' => unserialize($fields[0]->options)
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\EditFieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->assertEquals('defaultTwo', $field->default);
    }

}