<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator;


/**
 * Class DeleteFieldCommand
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator
 */
class DeleteFieldCommand
{
    /**
     * Field ID
     * @var
     */
    public $id;

    /**
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
}