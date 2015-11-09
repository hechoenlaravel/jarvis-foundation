<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

use Hechoenlaravel\JarvisFoundation\Flows\DeleteFlowCommand;
use Hechoenlaravel\JarvisFoundation\Flows\DeleteStepCommand;
use Hechoenlaravel\JarvisFoundation\Flows\DeleteTransitionCommand;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\DeleteFlowCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\DeleteStepCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\DeleteTransitionCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Step;
use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Flows\EditFlowCommand;
use Hechoenlaravel\JarvisFoundation\Flows\EditStepCommand;
use Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand;
use Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand;
use Hechoenlaravel\JarvisFoundation\Flows\CreateTransitionCommand;
use Hechoenlaravel\JarvisFoundation\Flows\Middleware\SetStepOrder;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\EditFlowCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\EditStepCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateFlowCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateStepCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateTransitionCommandHandler;
use Hechoenlaravel\JarvisFoundation\Flows\Transition;

trait FlowManager {

    use DispatchesCommands;

    public function createFlow(array $data)
    {
        return $this->execute(CreateFlowCommand::class, CreateFlowCommandHandler::class, $data);
    }

    public function updateFlow(Flow $flow, array $data)
    {
        return $this->execute(EditFlowCommand::class, EditFlowCommandHandler::class, array_merge(['flow' => $flow], $data));
    }

    public function deleteFlow(Flow $flow)
    {
        return $this->execute(DeleteFlowCommand::class, DeleteFlowCommandHandler::class, ['flow' => $flow]);
    }

    public function createStep(array $data)
    {
        return $this->execute(CreateStepCommand::class, CreateStepCommandHandler::class, $data,[SetStepOrder::class]);
    }

    public function updateStep(Step $step, array $data)
    {
        return $this->execute(EditStepCommand::class, EditStepCommandHandler::class, array_merge(['step' => $step], $data));
    }

    public function deleteStep(Step $step)
    {
        return $this->execute(DeleteStepCommand::class, DeleteStepCommandHandler::class, ['step' => $step]);
    }

    public function createTransition(array $data)
    {
        return $this->execute(CreateTransitionCommand::class, CreateTransitionCommandHandler::class, $data, []);
    }

    public function deleteTransition(Transition $transition)
    {
        return $this->execute(DeleteTransitionCommand::class, DeleteTransitionCommandHandler::class, ['transition' => $transition], []);
    }

}