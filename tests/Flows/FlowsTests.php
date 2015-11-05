<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\Flows;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;

class FlowsTests extends TestCase{

    public function createFlow()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateFlowCommandHandler');
        return $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand', [
            'name' => 'Tasks Flow',
            'description' => 'This is the tasks flow'
        ], []);
    }

    /**
     * @test
     */
    public function it_can_create_a_flow()
    {
        $this->createFlow();
        $this->seeInDatabase('fl_flows', [
            'name' => 'Tasks Flow',
            'description' => 'This is the tasks flow'
        ]);
    }

    /**
     * @test
     */
    public function it_creates_a_step_for_a_flow()
    {
        $flow = $this->createFlow();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateStepCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand', [
            'flow' => $flow,
            'name' => 'Step Flow',
            'description' => 'This is a Step in the flow'
        ], [
            'Hechoenlaravel\JarvisFoundation\Flows\Middleware\SetStepOrder'
        ]);
        $this->seeInDatabase('fl_flows_steps', [
            'flow_id' => $flow->id,
            'name' => 'Step Flow',
            'description' => 'This is a Step in the flow',
            'order' => 1,
            'is_last' => 0
        ]);
    }

    /**
     * @test
     */
    public function it_creates_a_step_for_a_flow_with_order_re_arrange()
    {
        $flow = $this->createFlow();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateStepCommandHandler');
        for($x = 1; $x < 6; $x++)
        {
            $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand', [
                'flow' => $flow,
                'name' => 'Step Flow '.$x,
                'description' => 'This is a Step in the flow '.$x,
                'order' => $x
            ], [
                'Hechoenlaravel\JarvisFoundation\Flows\Middleware\SetStepOrder'
            ]);
        }
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand', [
            'flow' => $flow,
            'name' => 'Step Flow reorder',
            'description' => 'This is a Step in the flow',
            'order' => 3
        ], [
            'Hechoenlaravel\JarvisFoundation\Flows\Middleware\SetStepOrder'
        ]);
        $this->seeInDatabase('fl_flows_steps', [
            'flow_id' => $flow->id,
            'name' => 'Step Flow reorder',
            'description' => 'This is a Step in the flow',
            'order' => 3,
            'is_last' => 0
        ]);
        $this->seeInDatabase('fl_flows_steps', [
            'flow_id' => $flow->id,
            'name' => 'Step Flow 3',
            'description' => 'This is a Step in the flow 3',
            'order' => 4,
            'is_last' => 0
        ]);
        $this->seeInDatabase('fl_flows_steps', [
            'flow_id' => $flow->id,
            'name' => 'Step Flow 4',
            'description' => 'This is a Step in the flow 4',
            'order' => 5,
            'is_last' => 0
        ]);
    }

}