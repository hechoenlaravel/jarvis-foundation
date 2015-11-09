<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;


use Hechoenlaravel\JarvisFoundation\Flows\Events\FlowWasDeleted;

/**
 * Class DeleteFlowCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class DeleteFlowCommandHandler {

    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $flow = $command->flow->toArray();
        $command->flow->delete();
        event(new FlowWasDeleted($flow));
        return $flow;
    }

}