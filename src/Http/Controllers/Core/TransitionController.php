<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Hechoenlaravel\JarvisFoundation\Flows\Transition;
use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Flows\Step;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\TransitionTransformer;

class TransitionController extends Controller
{
    use ResponderTrait, FlowManager;

    public function store(Requests\TransitionRequest $request)
    {
        $transition = $this->createTransition([
            'flow' => Flow::find($request->get('flow_id')),
            'from' => Step::find($request->get('from')),
            'to' => Step::find($request->get('to'))
        ]);
        return $this->responseWithItem($transition, new TransitionTransformer());
    }

    public function destroy($id)
    {
        $this->deleteTransition(Transition::findOrFail($id));
        return $this->responseNoContent();
    }
}
