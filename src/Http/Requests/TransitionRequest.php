<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransitionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'flow_id' => 'required|exists:fl_flows,id',
            'from' => 'required|exists:fl_flows_steps,id',
            'to' => 'required|exists:fl_flows_steps,id'
        ];
    }
}
