<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Class EntryWasInserted
 * @package Hechoenlaravel\JarvisFoundation\Entries\Events
 */
class EntryWasInserted extends Event
{

    /**
     * @var EntityModel
     */
    public $entity;

    /**
     * @var
     */
    public $entry;

    /**
     *
     * @var
     */
    public $data;

    /**
     * @param EntityModel $entity
     * @param $entry
     */
    public function __construct(EntityModel $entity, $entry, $data)
    {
        $this->entity = $entity;
        $this->entry = $entry;
        $this->data = $data;
    }

}