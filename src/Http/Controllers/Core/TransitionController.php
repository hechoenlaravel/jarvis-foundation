<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Flows\Step;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Hechoenlaravel\JarvisFoundation\Flows\Transition;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\TransitionTransformer;

/**
 * Class TransitionController
 * @package Hechoenlaravel\JarvisFoundation\Http\Controllers\Core
 */
class TransitionController extends Controller
{
    use FlowManager;

    /**
     * @param Requests\TransitionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Requests\TransitionRequest $request)
    {
        $transition = $this->createTransition([
            'flow' => Flow::find($request->get('flow_id')),
            'from' => Step::find($request->get('from')),
            'to' => Step::find($request->get('to'))
        ]);
        $response = fractal()->item($transition, new TransitionTransformer())->toArray();
        return response()->json($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->deleteTransition(Transition::findOrFail($id));
        return response()->json(null, 204);
    }
}
