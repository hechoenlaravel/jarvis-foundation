<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

use Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateFlowCommandHandler;

trait FlowManager {

    use DispatchesCommands;

    public function createFlow(array $data)
    {
        return $this->execute(CreateFlowCommand::class, CreateFlowCommandHandler::class, $data);
    }

}