<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Flows\Step;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Joselfonseca\LaravelApiTools\Traits\ResponderTrait;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\StepTransformer;

class StepController extends Controller
{
    use ResponderTrait, FlowManager;

    public function index(Request $request)
    {
        $step = Step::with('transitions')->orderBy('order', 'asc');
        if ($request->has('flow_id')) {
            $step->where('flow_id', $request->get('flow_id'));
        }
        return $this->responseWithCollection($step, new StepTransformer());
    }

    public function store(Requests\StepRequest $request)
    {
        $input = $request->only(['flow_id', 'name', 'description']);
        $input['flow'] = Flow::find($input['flow_id']);
        $step = $this->createStep($input);
        return $this->responseWithItem($step, new StepTransformer());
    }

    public function update(Requests\StepRequest $request, $id)
    {
        $step = $this->updateStep(Step::findOrFail($id), $request->all());
        return $this->responseWithItem($step, new StepTransformer());
    }

    public function destroy($id)
    {
        $this->deleteStep(Step::findOrFail($id));
        return $this->responseNoContent();
    }
}
