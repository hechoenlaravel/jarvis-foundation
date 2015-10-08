<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use League\Tactician\Middleware;

/**
 * Class FieldOptionsSerializer
 * Serialize the options field
 * @author Jose Luis Fonseca <jose@ditecnologia.com>
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware
 */
class FieldOptionsSerializer implements Middleware{


    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $command->options = serialize($command->options);
        return $next($command);
    }
}