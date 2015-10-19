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
                'required', 1,
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

    public function test_it_saves_an_entry_for_entity()
    {
        $entity = $this->getAnEntity();
        $fields = $this->setFieldsForEntryTests($entity);
        
    }

}