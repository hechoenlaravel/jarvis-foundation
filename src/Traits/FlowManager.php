<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

use Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand;
use Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand;
use Hechoenlaravel\JarvisFoundation\Flows\Middleware\SetStepOrder;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateFlowCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateStepCommandHandler;

trait FlowManager {

    use DispatchesCommands;

    public function createFlow(array $data)
    {
        return $this->execute(CreateFlowCommand::class, CreateFlowCommandHandler::class, $data);
    }

    public function createStep(array $data)
    {
        return $this->execute(CreateStepCommand::class, CreateStepCommandHandler::class, $data,[SetStepOrder::class]);
    }

}