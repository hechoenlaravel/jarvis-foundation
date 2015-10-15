<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use League\Tactician\Middleware;

class CreateTheFieldSlug implements Middleware{

    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        if(empty($command->slug)){
            $command->slug = str_slug($command->name, '_');
        }
        return $next($command);
    }
}