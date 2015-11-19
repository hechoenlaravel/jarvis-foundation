<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Middleware;

use League\Tactician\Middleware;

class FilterFieldFromInput implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $fields = $command->entity->fields->pluck('slug', 'slug')->toArray();
        foreach ($command->input as $key => $input) {
            if (!isset($fields[$key])) {
                unset($command->input[$key]);
            }
        }
        return $next($command);
    }
}
