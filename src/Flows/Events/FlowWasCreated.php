<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Events;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Events\Event;

/**
 * Class FlowWasCreated
 * A new flow has been created
 * @package Hechoenlaravel\JarvisFoundation\Flows\Events
 */
class FlowWasCreated extends Event{

    /**
     * The flow model
     * @var
     */
    public $flow;

    /**
     * @param Flow $model
     */
    public function __construct(Flow $model)
    {
        $this->flow = $model;
    }

}