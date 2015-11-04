<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\Flows;

use Hechoenlaravel\JarvisFoundation\Tests\TestCase;

class FlowsTests extends TestCase{

    public function prepare()
    {
        $this->migrateDatabase();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        return [
            'bus' => $bus
        ];
    }

    /**
     * @test
     */
    public function It_can_create_a_flow()
    {
        $t = $this->prepare();
        $bus = $t['bus'];
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand',
            'Hechoenlaravel\JarvisFoundation\Flows\Handler\CreateFlowCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Flows\CreateFlowCommand', [
            'name' => 'Tasks Flow',
            'description' => 'This is the tasks flow'
        ], []);
        $this->seeInDatabase('fl_flows', [
            'name' => 'Tasks Flow',
            'description' => 'This is the tasks flow'
        ]);
    }

}