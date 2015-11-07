<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\FlowTransformer;

class FlowController extends Controller{

    use ResponderTrait, FlowManager;


    public function store(Requests\FlowRequest $request)
    {
        $flow = $this->createFlow($request->all());
        return $this->responseWithItem($flow, new FlowTransformer());
    }

}