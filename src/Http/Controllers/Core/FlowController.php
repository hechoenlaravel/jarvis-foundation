<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;

class FlowController extends Controller{

    use ResponderTrait, FlowManager;


    public function store(Requests\CreateFlowRequest $request)
    {
        $flow = $this->createFlow($request->all());
        return $this->simpleArray($flow->toArray());
    }

}