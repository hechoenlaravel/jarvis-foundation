<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;


/**
 * Class CreateFlowCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class CreateFlowCommand {

    /**
     * The flow name
     * @var
     */
    public $name;

    /**
     * The flow description
     * @var
     */
    public $description;

    /**
     * @var
     */
    public $module;

    /**
     * The flow state, is active or not
     * @var
     */
    public $active;

    /**
     * @param $name
     * @param $description
     * @param bool $active
     */
    public function __construct($name, $description, $module = false, $active = false)
    {
        $this->name = $name;
        $this->description = $description;
        $this->module = $module;
        $this->active = $active;
    }

}