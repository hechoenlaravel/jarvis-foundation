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
            'updated' => $flow->updated_at
        ];
    }
}