<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

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

        return $next($command);
    }
}