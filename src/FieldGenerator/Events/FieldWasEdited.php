<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;

/**
 * Class FieldWasEdited
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator\Events
 */
class FieldWasEdited extends Event
{
    /**
     * Field generated
     * @var
     */
    public $field;

    /**
     * @var bool
     */
    public $rename = false;

    /**
     * Old Slug
     */
    public $oldSlug;

    /**
     * The model created
     * @param FieldModel $model
     */
    public function __construct(FieldModel $model, $rename, $oldSlug = "")
    {
        $this->field = $model;
        $this->rename = $rename;
        $this->oldSlug = $oldSlug;
    }
}
