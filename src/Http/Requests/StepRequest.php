<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required'
        ];
    }
}
