<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

use Hechoenlaravel\JarvisFoundation\Flows\Step;

/**
 * Class StepWasDeleted
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class StepWasDeleted
{
    /**
     * @var
     */
    public $step;

    /**
     * @param Step $step
     */
    public function __construct(array $step)
    {
        $this->step = $step;
    }
}
