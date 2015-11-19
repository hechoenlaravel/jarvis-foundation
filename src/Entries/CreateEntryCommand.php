<?php

namespace Hechoenlaravel\JarvisFoundation\Entries;

/**
 * Class CreateEntryCommand
 * @package Hechoenlaravel\JarvisFoundation\Entries
 */
class CreateEntryCommand
{
    /**
     * The Entity
     * @var
     */
    public $entity;

    /**
     * The data to be stored
     * @var array
     */
    public $input = [];

    /**
     * CreateEntryCommand constructor.
     * @param $entity
     * @param array $data
     */
    public function __construct($entity, array $input)
    {
        $this->entity = $entity;
        $this->input = $input;
    }
}
