<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Middleware;

use Hechoenlaravel\JarvisFoundation\Flows\Step;
use League\Tactician\Middleware;

class SetStepOrder implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        if ($command->order === null) {
            $this->setOrder($command);
        } else {
            $this->reOrderSteps($command);
        }
        return $next($command);
    }

    /**
     * @param $command
     */
    private function reOrderSteps($command)
    {
        Step::where('flow_id', $command->flow->id)
            ->where('order', '>=', $command->order)
            ->orderBy('order', 'ASC')
            ->get()
            ->each(function ($step) {
                $step->order = $step->order + 1;
                $step->save();
            });
    }

    /**
     * @param $command
     */
    private function setOrder($command)
    {
        $command->order = 1;
        $lastStep = Step::where('flow_id', $command->flow->id)->orderBy('order', 'asc')->first();
        if ($lastStep) {
            $command->order = $lastStep->order + 1;
        }
    }
}
