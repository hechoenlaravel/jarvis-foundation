<?php

namespace Hechoenlaravel\JarvisFoundation\Exceptions;

use Illuminate\Validation\Validator;

/**
 * Class FieldValidationException
 * @package Hechoenlaravel\JarvisFoundation\Exceptions
 */
class FieldValidationException extends \Exception{

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * Get the Validator Instance
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Get Errors Bag
     * @return mixed
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }
}