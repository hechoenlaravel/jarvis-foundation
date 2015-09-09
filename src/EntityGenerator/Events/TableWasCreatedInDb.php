<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

class TableWasCreatedInDb extends Event{

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