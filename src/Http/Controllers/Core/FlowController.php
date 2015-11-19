<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\FlowTransformer;

/**
 * Class FlowController
 * @package Hechoenlaravel\JarvisFoundation\Http\Controllers\Core
 */
class FlowController extends Controller
{
    use ResponderTrait, FlowManager;


    /**
     * @param Requests\FlowRequest $request
     * @return mixed
     */
    public function store(Requests\FlowRequest $request)
    {
        $flow = $this->createFlow($request->all());
        return $this->responseWithItem($flow, new FlowTransformer());
    }

    /**
     * @param Requests\FlowRequest $request
     * @param $id
     * @return mixed
     */
    public function update(Requests\FlowRequest $request, $id)
    {
        $flow = $this->updateFlow(Flow::findOrFail($id), $request->all());
        return $this->responseWithItem($flow, new FlowTransformer());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->deleteFlow(Flow::findOrFail($id));
        return $this->responseNoContent();
    }
}
