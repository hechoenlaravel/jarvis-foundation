<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\EntityEntries;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;

class TestEntriesCommands extends TestCase{

    protected function setFieldsForEntryTests($entity)
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
                'required' => 1,
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

    public function getEntityWithFields()
    {
        $entity = $this->getAnEntity();
        $this->setFieldsForEntryTests($entity);
        return $entity;
    }


    /**
     * @expectedException Hechoenlaravel\JarvisFoundation\Exceptions\EntryValidationException
     */
    public function test_it_validates_an_entry_for_entity_and_throws_exception_if_missing_data()
    {
        $this->migrateDatabase();
        $entity = $this->getEntityWithFields();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\CreateEntryCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand', [
            'entity' => $entity->id,
            'input' => [
                'last_name' => 'Fonseca'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
        ]);
    }

    public function test_it_runs_pre_save_method_in_field_type()
    {
        $this->migrateDatabase();
        $entity = $this->getEntityWithFields();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\CreateEntryCommandHandler');
        $entry = $bus->dispatch('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand', [
            'entity' => $entity->id,
            'input' => [
                'first_name' => 'JOSE LUIS',
                'last_name' => 'Fonseca'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
        ]);
        $this->assertEquals('jose luis', $entry['input']['first_name']);
    }

    public function test_it_saves_the_entry()
    {
        $this->migrateDatabase();
        $entity = $this->getEntityWithFields();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\CreateEntryCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand', [
            'entity' => $entity->id,
            'input' => [
                'first_name' => 'Jose Luis',
                'last_name' => 'Fonseca'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
        ]);
        $this->seeInDatabase($entity->getTableName(), [
            'first_name' => 'jose luis',
            'last_name' => 'fonseca'
        ]);
    }

}