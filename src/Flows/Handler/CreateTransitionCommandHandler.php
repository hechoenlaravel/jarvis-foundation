<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;

use Hechoenlaravel\JarvisFoundation\Flows\Transition;
use Hechoenlaravel\JarvisFoundation\Flows\Events\TransitionWasCreated;

/**
 * Class CreateTransitionCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class CreateTransitionCommandHandler
{
    /**
     * @param $command
     * @return static
     */

    public function handle($command)
    {
        $transition = Transition::create([
            'flow_id' => $command->flow->id,
            'step_from_id' => $command->from->id,
            'step_to_id' => $command->to->id,
        ]);
        event(new TransitionWasCreated($transition));
        return $transition;
    }
}
