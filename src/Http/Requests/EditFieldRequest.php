<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Edit a Field Request
 * Class EditFieldRequest
 * @package Hechoenlaravel\JarvisFoundation\Http\Requests
 */
class EditFieldRequest extends FormRequest
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
