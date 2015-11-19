<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Class EntryWasUpdated
 * @package Hechoenlaravel\JarvisFoundation\Entries\Events
 */
class EntryWasUpdated extends Event
{
    /**
     * @var EntityModel
     */
    public $entity;

    /**
     * @var
     */
    public $entry_id;

    /**
     *
     * @var
     */
    public $data;

    /**
     * @param EntityModel $entity
     * @param $entry
     */
    public function __construct(EntityModel $entity, $entry_id, $data)
    {
        $this->entity = $entity;
        $this->entry_id = $entry_id;
        $this->data = $data;
    }
}
