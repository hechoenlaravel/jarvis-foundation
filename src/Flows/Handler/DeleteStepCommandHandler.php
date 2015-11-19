<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;

use Hechoenlaravel\JarvisFoundation\Flows\Events\StepWasDeleted;

/**
 * Class DeleteStepCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class DeleteStepCommandHandler
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $step = $command->step->toArray();
        $command->step->delete();
        event(new StepWasDeleted($step));
        return $step;
    }
}
