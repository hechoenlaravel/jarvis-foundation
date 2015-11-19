<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Requests;

use Joselfonseca\LaravelApiTools\Http\Requests\ApiRequest;

class CreateFieldRequest extends ApiRequest
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
            'name' => 'required',
            'type' => 'required',
            'description' => 'required'
        ];
    }
}
