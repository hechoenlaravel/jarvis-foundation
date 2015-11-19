<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use Validator;
use League\Tactician\Middleware;
use Hechoenlaravel\JarvisFoundation\Exceptions\FieldValidationException;

class EditFieldTypeValidator implements Middleware
{
    /**
     * Rules to validate a Field
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'id' => 'required|exists:app_entities_fields,id',
    ];

    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $validator = Validator::make((array) $command, $this->rules);
        if ($validator->fails()) {
            throw new FieldValidationException($validator);
        }
        return $next($command);
    }
}
