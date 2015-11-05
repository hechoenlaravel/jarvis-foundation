<?php


namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;


use Hechoenlaravel\JarvisFoundation\Flows\Events\StepWasCreated;

class CreateStepCommandHandler {

    public function handle($command)
    {
        $flow = $command->flow;
        unset($command->flow);
        $step = $flow->steps()->create((array) $command);
        event(new StepWasCreated($step));
        return $step;
    }

}