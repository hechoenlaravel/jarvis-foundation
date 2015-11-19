<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator;

/**
 * Class ReOrderFieldCommand
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator
 */
class ReOrderFieldCommand
{
    /**
     * @var
     */
    public $fields;

    /**
     * @param $fields
     */
    public function __construct($fields)
    {
        $this->fields = $fields;
    }
}
