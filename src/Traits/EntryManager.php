<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

use DispatchesCommands;

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
            'Hechoenlaravel\JarvisFoundation\Entries\CreateEntryCommandHandler', $input, [
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\SetEntity',
                'Hechoenlaravel\JarvisFoundation\Entries\Middleware\ValidateEntryData'
            ]);
    }

}