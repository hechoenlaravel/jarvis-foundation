<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\FlowTransformer;

/**
 * Class FlowController
 * @package Hechoenlaravel\JarvisFoundation\Http\Controllers\Core
 */
class FlowController extends Controller
{
    use FlowManager;


    /**
     * @param Requests\FlowRequest $request
     * @return mixed
     */
    public function store(Requests\FlowRequest $request)
    {
        $flow = $this->createFlow($request->all());
        $response = fractal()->item($flow, new FlowTransformer)->toArray();
        return response()->json($response);
    }

    /**
     * @param Requests\FlowRequest $request
     * @param $id
     * @return mixed
     */
    public function update(Requests\FlowRequest $request, $id)
    {
        $flow = $this->updateFlow(Flow::findOrFail($id), $request->all());
        $response = fractal()->item($flow, new FlowTransformer)->toArray();
        return response()->json($response);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->deleteFlow(Flow::findOrFail($id));
        return response()->json(null, 204);
    }
}
