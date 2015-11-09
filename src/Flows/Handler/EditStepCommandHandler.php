<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;

use Hechoenlaravel\JarvisFoundation\Flows\Events\StepWasUpdated;

/**
 * Class EditStepCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class EditStepCommandHandler {

    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $step = $command->step;
        unset($command->step);
        $step->fill((array) $command);
        $step->save();
        event(new StepWasUpdated($step));
        return $step;
    }

}