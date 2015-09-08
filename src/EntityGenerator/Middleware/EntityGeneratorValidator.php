<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware;

use Hechoenlaravel\JarvisFoundation\Exceptions\CommandValidationException;
use League\Tactician\Middleware;
use Illuminate\Support\Facades\Validator;

/**
 * Class EntityGeneratorValidator
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware
 */
class EntityGeneratorValidator implements Middleware{

    /**
     * @var
     */
    public $validator;

    /**
     * validation rules
     * @var array
     */
    public $rules = [
        'namespace' => 'required',
        'name' => 'required',
        'description' => 'required',
        'slug' => 'required',
        'locked' => 'required|boolean'
    ];

    /**
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }


    /**
     * Validates the data coming into the handler
     * @param object $command
     * @param callable $next
     * @return mixed
     * @throws CommandValidationException
     */
    public function execute($command, callable $next)
    {
        $validator = Validator::make((array) $command, $this->rules);
        if ($validator->fails()) {
            throw new CommandValidationException($validator);
        }
        return $next($command);
    }
}