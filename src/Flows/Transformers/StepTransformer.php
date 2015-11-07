<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Transformers;

use League\Fractal\TransformerAbstract;
use Hechoenlaravel\JarvisFoundation\Flows\Step;

/**
 * Class StepTransformer
 * @package Hechoenlaravel\JarvisFoundation\Flows\Transformers
 */
class StepTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['transitions'];

    /**
     * @param Step $step
     * @return array
     */
    public function transform(Step $step)
    {
        return [
            'id' => (int) $step->id,
            'name' => $step->name,
            'description' => $step->description,
            'total_transitions' => $step->transitions->count()
        ];
    }

    public function includeTransitions(Step $step)
    {
        if($step->transitions()->count() === 0)
        {
            return null;
        }
        $collection = $this->collection($step->transitions, new TransitionTransformer);
        return $collection;
    }
}