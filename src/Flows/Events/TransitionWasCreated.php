<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\Flows\Transition;

/**
 * Class TransitionWasCreated
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class TransitionWasCreated extends Event{

    /**
     * @var Transition
     */
    public $transition;

    /**
     * @param Transition $transition
     */
    public function __construct(Transition $transition)
    {
        $this->transition = $transition;
    }

}