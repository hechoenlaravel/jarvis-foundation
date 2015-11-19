<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Class EntityWasCreated
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator\Events
 */
class EntityWasCreated extends Event
{
    /**
     * Entity generated
     * @var
     */
    public $entity;

    /**
     * @param EntityModel $model
     */
    public function __construct(EntityModel $model)
    {
        $this->entity = $model;
    }
}
