<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;

class FieldWasCreatedInDb extends Event
{
    /**
     * Field generated
     * @var
     */
    public $field;

    /**
     * The model created
     * @param FieldModel $model
     */
    public function __construct(FieldModel $model)
    {
        $this->field = $model;
    }
}
