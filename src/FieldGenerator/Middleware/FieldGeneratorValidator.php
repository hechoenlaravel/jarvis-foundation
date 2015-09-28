<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use Hechoenlaravel\JarvisFoundation\Exceptions\FieldValidationException;
use League\Tactician\Middleware;
use Validator;

/**
 * Class FieldGeneratorValidator
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware
 */
class FieldGeneratorValidator implements Middleware{

    /**
     * Rules to validate a Field
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'entity_id' => 'required|exists:app_entities,id',
        'type' => 'required'
    ];

    /**
     * Validate field type information
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $validator = Validator::make((array) $command, $this->rules);
        if($validator->fails())
        {
            throw new FieldValidationException($validator);
        }
        return $next($command);
    }
}