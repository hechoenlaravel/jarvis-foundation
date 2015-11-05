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

    public function createSteps($flow)
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateStepCommandHandler');
        $steps = [];
        for($x = 1; $x < 6; $x++)
        {
            $steps[] = $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand', [
                'flow' => $flow,
                'name' => 'Step Flow '.$x,
                'description' => 'This is a Step in the flow '.$x,
                'order' => $x
            ], [
                'Hechoenlaravel\JarvisFoundation\Flows\Middleware\SetStepOrder'
            ]);
        }
        return $steps;
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
        $this->createSteps($flow);
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateStepCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateStepCommandHandler');
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

    /**
     * @test
     */
    public function it_creates_a_transition()
    {
        $flow = $this->createFlow();
        $steps = $this->createSteps($flow);
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateTransitionCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateTransitionCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateTransitionCommand', [
            'flow' => $flow,
            'from' => $steps[0],
            'to' => $steps[1]
        ], []);
        $this->seeInDatabase('fl_flows_steps_transitions', [
            'flow_id' => $flow->id,
            'step_from_id' => $steps[0]->id,
            'step_to_id' => $steps[1]->id
        ]);
    }

}