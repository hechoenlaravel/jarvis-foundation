<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;

/**
 * Class EditFlowCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class EditFlowCommand
{
    /**
     * @var Flow
     */
    public $flow;

    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $description;

    /**
     * @var int
     */
    public $active;

    /**
     * @param Flow $flow
     * @param $name
     * @param $description
     * @param int $active
     */
    public function __construct(Flow $flow, $name, $description, $active = 0)
    {
        $this->flow = $flow;
        $this->name = $name;
        $this->description = $description;
        $this->active = $active;
    }
}
