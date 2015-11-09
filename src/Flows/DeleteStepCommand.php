<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;


/**
 * Class DeleteStepCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class DeleteStepCommand {

    /**
     * @var
     */
    public $step;

    /**
     * @param Step $step
     */
    public function __construct(Step $step)
    {
        $this->step = $step;
    }

}