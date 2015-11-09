<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;


/**
 * Class TransitionWasDeleted
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class TransitionWasDeleted {

    /**
     * @var
     */
    public $transition;

    /**
     * @param array $transition
     */
    public function __construct(array $transition)
    {
        $this->transition = $transition;
    }

}