<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers\Core;

use Illuminate\Http\Request;
use Hechoenlaravel\JarvisFoundation\Flows\Flow;
use Hechoenlaravel\JarvisFoundation\Flows\Step;
use Hechoenlaravel\JarvisFoundation\Http\Requests;
use Hechoenlaravel\JarvisFoundation\Traits\FlowManager;
use Hechoenlaravel\JarvisFoundation\Http\Controllers\Controller;
use Hechoenlaravel\JarvisFoundation\Flows\Transformers\StepTransformer;

/**
 * Class StepController
 * @package Hechoenlaravel\JarvisFoundation\Http\Controllers\Core
 */
class StepController extends Controller
{
    use FlowManager;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $step = Step::with('transitions')->orderBy('order', 'asc');
        if ($request->has('flow_id')) {
            $step->where('flow_id', $request->get('flow_id'));
        }
        $response = fractal()->collection($step, new StepTransformer())->toArray();
        return response()->json($response);
    }

    /**
     * @param Requests\StepRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Requests\StepRequest $request)
    {
        $input = $request->only(['flow_id', 'name', 'description']);
        $input['flow'] = Flow::find($input['flow_id']);
        $step = $this->createStep($input);
        $response = fractal()->item($step, new StepTransformer())->toArray();
        return response()->json($response);
    }

    /**
     * @param Requests\StepRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Requests\StepRequest $request, $id)
    {
        $step = $this->updateStep(Step::findOrFail($id), $request->all());
        $response = fractal()->item($step, new StepTransformer())->toArray();
        return response()->json($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->deleteStep(Step::findOrFail($id));
        return response()->json(null, 204);
    }
}
