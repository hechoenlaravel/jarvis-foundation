<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;

/**
 * Class FlowWasUpdated
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class FlowWasUpdated {

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