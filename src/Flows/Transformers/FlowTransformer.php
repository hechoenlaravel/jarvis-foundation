<?php

namespace Hechoenlaravel\JarvisFoundation\Flows\Transformers;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use League\Fractal\TransformerAbstract;

/**
 * Class FlowTransformer
 * @package Hechoenlaravel\JarvisFoundation\Flows\Transformers
 */
class FlowTransformer extends TransformerAbstract
{

    /**
     * @var array
     */
    protected $availableIncludes = ['steps'];

    /**
     * @param Flow $flow
     * @return array
     */
    public function transform(Flow $flow)
    {
        return [
            'id' => (int) $flow->id,
            'name' => $flow->name,
            'description' => $flow->description,
            'created' => $flow->created_at,
            'updated' => $flow->updated_at,
            'active' => $flow->active
        ];
    }

    /**
     * @param Flow $flow
     * @return \League\Fractal\Resource\Collection|null
     */
    public function includeSteps(Flow $flow)
    {
        if($flow->steps->count() > 0)
        {
            return $this->collection($flow->steps, new StepTransformer());
        }
        return null;
    }
}