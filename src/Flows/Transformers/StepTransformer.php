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
    /**
     * @param Step $step
     * @return array
     */
    public function transform(Step $step)
    {
        return [
            'id' => (int) $step->id,
            'name' => $step->name,
            'description' => $step->description
        ];
    }
}