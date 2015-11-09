<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;


/**
 * Class DeleteFlowCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class DeleteFlowCommand {

    /**
     * @var
     */
    public $flow;

    /**
     * @param Flow $flow
     */
    public function __construct(Flow $flow)
    {
        $this->flow = $flow;
    }

}