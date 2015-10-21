<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

/**
 * Trait EntryManager
 * Use this trait to manage entries for the entities
 * @author Jose Luis Fonseca <jose@ditecnologia.com>
 * @package Hechoenlaravel\JarvisFoundation\Traits
 */
trait EntryManager
{

    use DispatchesCommands;

    /**
     * @param $entityId
     * @param array $input
     * @return mixed
     */
    public function createEntry($entityId, array $input = [])
    {
        $input['entity'] = $entityId;
        return $this->execute('Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\CreateEntryCommandHandler', $input, [
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
            ]);
    }

    /**
     * @param $entityId
     * @param array $input
     * @return mixed
     */
    public function updateEntry($entityId, $entryId, array $input = [])
    {
        $input['entity'] = $entityId;
        $input['entry_id'] = $entryId;
        return $this->execute('Hechoenlaravel\JarvisFoundation\Entries\UpdateEntryCommand',
            'Hechoenlaravel\JarvisFoundation\Entries\Handler\UpdateEntryCommandHandler', $input, [
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData',
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\FilterFieldFromInput',
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\RunPreSaveEvent'
            ]);
    }

}