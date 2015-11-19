<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;

class FieldWasDeleted extends Event
{
    /**
     * Field generated
     * @var
     */
    public $field;

    /**
     * The model info deleted
     * @param array $modelArray
     */
    public function __construct($modelArray)
    {
        $this->field = $modelArray;
    }
}
