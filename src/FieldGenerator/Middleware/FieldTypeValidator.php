<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use Hechoenlaravel\JarvisFoundation\Exceptions\FieldTypeNotRegistered;
use League\Tactician\Middleware;

class FieldTypeValidator implements Middleware{

    /**
     * Validates the Field type
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        /**
         * We need to check that the field type exists in the
         * field types declaration
         */
        $fields = app('field.types');
        if(!isset($fields->types[$command->type]))
        {
            throw new FieldTypeNotRegistered;
        }
        return $next($command);
    }
}