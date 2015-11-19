<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;

use Hechoenlaravel\JarvisFoundation\Flows\Events\FlowWasUpdated;

/**
 * Class EditFlowCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class EditFlowCommandHandler
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $flow = $command->flow;
        unset($command->flow);
        $flow->fill((array) $command);
        $flow->save();
        event(new FlowWasUpdated($flow));
        return $flow;
    }
}
