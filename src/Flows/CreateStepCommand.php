<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;


/**
 * Class CreateStepCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class CreateStepCommand {

    /**
     * @var
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
     * @var
     */
    public $order;

    /**
     * @var
     */
    public $isLast;

    /**
     * @param $flow
     * @param $name
     * @param $description
     * @param int $order
     * @param int $isLast
     */
    function __construct(Flow $flow, $name, $description, $order = null, $isLast = 0)
    {
        $this->flow = $flow;
        $this->name = $name;
        $this->description = $description;
        $this->order = $order;
        $this->isLast = $isLast;
    }

}