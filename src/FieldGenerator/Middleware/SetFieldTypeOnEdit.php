<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use League\Tactician\Middleware;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;

class SetFieldTypeOnEdit implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $field = FieldModel::find($command->id);
        $command->type = $field->type;
        return $next($command);
    }
}
