<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\EntityEntries;

class TestUpdateEntries extends TestEntriesCommands{

    protected function prepare()
    {
        $this->migrateDatabase();
        $entity = $this->getEntityWithFields();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\CreateEntryCommandHandler');
        $command = $bus->dispatch('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand', [
            'entity' => $entity->id,
            'input' => [
                'first_name' => 'Jose Luis',
                'last_name' => 'Fonseca'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\FilterFieldFromInput',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
        ]);
        return [
            'entry_id' => $command['entry_id'],
            'input' => $command['input'],
            'entity' => $entity
        ];
    }

    public function test_it_edits_an_entry()
    {
        $preparedData = $this->prepare();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Entries\UpdateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\UpdateEntryCommandHandler');
        $command = $bus->dispatch('Hechoenlaravel\JarvisFoundation\Entries\UpdateEntryCommand', [
            'entity' => $preparedData['entity']->id,
            'entry_id' => $preparedData['entry_id'],
            'input' => [
                'first_name' => 'Fabien',
                'last_name' => 'Symfony'
            ]
        ], [
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\FilterFieldFromInput',
            'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
        ]);
        $this->assertDatabaseHas($preparedData['entity']->getTableName(), [
            'id' => $preparedData['entry_id'],
            'first_name' => 'fabien',
            'last_name' => 'symfony'
        ]);
    }

}