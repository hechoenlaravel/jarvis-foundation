<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;

/**
 * Class EditStepCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class EditStepCommand
{
    /**
     * @var
     */
    public $step;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $description;

    /**
     * @param Step $step
     * @param $name
     * @param $description
     */
    public function __construct(Step $step, $name, $description)
    {
        $this->step = $step;
        $this->name = $name;
        $this->description = $description;
    }
}
