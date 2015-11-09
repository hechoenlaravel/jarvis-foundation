<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

use Hechoenlaravel\JarvisFoundation\Flows\Step;

/**
 * Class StepWasUpdate
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class StepWasUpdated {

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