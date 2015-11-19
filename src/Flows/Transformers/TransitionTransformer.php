<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Transformers;

use League\Fractal\TransformerAbstract;
use Hechoenlaravel\JarvisFoundation\Flows\Transition;

/**
 * Class TransitionTransformer
 * @package Hechoenlaravel\JarvisFoundation\Flows\Transformers
 */
class TransitionTransformer extends TransformerAbstract
{
    /**
     * @param Transition $transition
     * @return array
     */
    public function transform(Transition $transition)
    {
        return [
            'id' => (int) $transition->id,
            'from' => $transition->from->transformed()->toArray(),
            'to' => $transition->to->transformed()->toArray(),
            'created' => $transition->created_at,
            'updated' => $transition->updated_at
        ];
    }
}
