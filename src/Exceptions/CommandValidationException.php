<?php

namespace Hechoenlaravel\JarvisFoundation\Exceptions;

use Exception;
use Illuminate\Validation\Validator;

/**
 * Class CommandValidationException
 * @package Hechoenlaravel\JarvisFoundation\Exceptions
 */
class CommandValidationException extends Exception{

    /**
     * @var Validator
     */
    public $validator;

    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Get the errors for the exception
     * @return MessageBag Message bad instance
     */
    public function getErrors()
    {
        return $this->validator->errors();
    }

}