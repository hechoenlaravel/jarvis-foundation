<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Handler;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Flows\Events\FlowWasCreated;

/**
 * Class CreateFlowCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\Flows\Handler
 */
class CreateFlowCommandHandler
{
    /**
     * Create the flow in the database
     * @param $command
     * @return static
     */
    public function handle($command)
    {
        $flow = Flow::create((array)$command);
        event(new FlowWasCreated($flow));
        return $flow;
    }
}
