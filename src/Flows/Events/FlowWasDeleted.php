<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

/**
 * Class FlowWasDeleted
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class FlowWasDeleted
{
    /**
     * @var
     */
    public $flow;

    /**
     * @param array $flow
     */
    public function __construct(array $flow)
    {
        $this->flow = $flow;
    }
}
