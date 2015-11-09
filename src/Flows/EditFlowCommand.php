<?php

namespace Hechoenlaravel\JarvisFoundation\Flows;


class EditFlowCommand {

    public $flow;

    public $name;

    public $description;

    function __construct(Flow $flow, $name, $description)
    {
        $this->flow = $flow;
        $this->name = $name;
        $this->description = $description;
    }

}