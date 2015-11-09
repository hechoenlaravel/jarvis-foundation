<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;


use Hechoenlaravel\JarvisFoundation\Flows\Events\TransitionWasDeleted;

/**
 * Class DeleteTransitionCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class DeleteTransitionCommandHandler {

    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $transition = $command->transition->toArray();
        $command->transition->delete();
        event(new TransitionWasDeleted($transition));
        return $transition;
    }

}