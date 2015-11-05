<?php


namespace Hechoenlaravel\JarvisFoundation\Flows;


/**
 * Class CreateTransitionCommand
 * @package Hechoenlaravel\JarvisFoundation\Flows
 */
class CreateTransitionCommand {

    /**
     * @var
     */
    public $flow;

    /**
     * @var
     */
    public $from;

    /**
     * @var
     */
    public $to;

    /**
     * @param Flow $flow
     * @param Step $from
     * @param Step $to
     */
    public function __construct(Flow $flow, Step $from, Step $to)
    {
        $this->flow = $flow;
        $this->from = $from;
        $this->to = $to;
    }

}