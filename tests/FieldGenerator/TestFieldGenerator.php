<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\FieldGenerator;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\Exceptions\FieldTypeNotRegistered;

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
        $FieldCreatorCommand = app('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand');
        $this->assertInstanceOf('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            $FieldCreatorCommand);
    }

    public function test_it_validates_field_type_is_valid()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        try {
            $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $entity = $this->getAnEntity();
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $this->assertDatabaseHas('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
    }

    public function test_it_creates_the_field_in_table()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $entity = $this->getAnEntity();
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $this->assertDatabaseHas('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
        $this->assertTrue(\Schema::hasColumn($entity->getTableName(), 'first_name'));
    }

    public function test_it_does_not_creates_the_field_in_table_as_per_instruction()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $entity = $this->getAnEntity();
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $this->assertDatabaseHas('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name']);
        $this->assertFalse(\Schema::hasColumn($entity->getTableName(), 'first_name'));
    }

    public function test_serializes_the_options_property()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $entity = $this->getAnEntity();
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $entity = $this->getAnEntity();
        $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler');
        $entity = $this->getAnEntity();
        $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand', [
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
        $this->assertDatabaseHas('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name', 'order' => 2]);
    }

    public function test_it_edits_a_field()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\EditFieldCommandHandler');
        $entity = $this->getAnEntity();
        $fields = $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldCommand', [
            'id' => $fields[0]->id,
            'name' => 'address',
            'description' => 'field Description',
            'default' => 'defaultTwo',
            'required' => $fields[0]->required,
            'options' => unserialize($fields[0]->options)
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\EditFieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\SetFieldTypeOnEdit',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\SetCommandDataFromEditFieldModel',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->assertEquals('defaultTwo', $field->default);
    }

    public function test_it_edits_a_field_in_db()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\EditFieldCommandHandler');
        $entity = $this->getAnEntity();
        $fields = $this->setSomeFields($entity);
        $field = $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldCommand', [
            'id' => $fields[0]->id,
            'name' => 'address',
            'description' => 'field Description',
            'default' => 'defaultTwo',
            'required' => $fields[0]->required,
            'options' => unserialize($fields[0]->options)
        ], [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\EditFieldTypeValidator',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\SetFieldTypeOnEdit',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\SetCommandDataFromEditFieldModel',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
        ]);
        $this->assertEquals('address', $field->slug);
        $this->assertFalse(\Schema::hasColumn($fields[0]->entity->getTableName(), 'first_name'));
        $this->assertTrue(\Schema::hasColumn($fields[0]->entity->getTableName(), 'address'));
    }

    public function test_it_re_order_fields()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\FieldGenerator\ReOrderFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\ReOrderFieldCommandHandler');
        $entity = $this->getAnEntity();
        $fields = $this->setSomeFields($entity);
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\FieldGenerator\ReOrderFieldCommand', [
            'fields' => [
                $fields[1]->id,
                $fields[0]->id
            ]
        ], [

        ]);
        $this->assertDatabaseHas('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'last_name', 'order' => 1]);
        $this->assertDatabaseHas('app_entities_fields', ['entity_id' => $entity->id, 'slug' => 'first_name', 'order' => 2]);
    }

}