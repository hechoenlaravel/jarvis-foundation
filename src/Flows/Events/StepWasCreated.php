<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

use Hechoenlaravel\JarvisFoundation\Flows\Step;
use Hechoenlaravel\JarvisFoundation\Events\Event;

/**
 * Class StepWasCreated
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class StepWasCreated extends Event{

    /**
     * The Step model
     * @var
     */
    public $step;

    /**
     * @param Step $model
     */
    public function __construct(Step $model)
    {
        $this->step = $model;
    }

}