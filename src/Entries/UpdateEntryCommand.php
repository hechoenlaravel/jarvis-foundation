<?php

namespace Hechoenlaravel\JarvisFoundation\Entries;


/**
 * Class UpdateEntryCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Entries
 */
class UpdateEntryCommand {

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
     * @var
     */
    public $entry_id;

    /**
     * CreateEntryCommand constructor.
     * @param $entity
     * @param array $data
     */
    public function __construct($entity, $entry_id, array $input)
    {
        $this->entity = $entity;
        $this->entry_id = $entry_id;
        $this->input = $input;
    }

}