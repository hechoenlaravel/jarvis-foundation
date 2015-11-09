<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;


/**
 * Class DeleteTransitionCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class DeleteTransitionCommand {

    /**
     * @var
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