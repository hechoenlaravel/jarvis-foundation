<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Middleware;

use League\Tactician\Middleware;

/**
 * Class RunPreSaveEvent
 * Run the pre save event for the fields
 * @package Hechoenlaravel\JarvisFoundation\Entries\Middleware
 */
class RunPreSaveEvent implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $fields = $command->entity->fields;
        foreach ($fields as $field) {
            $type = $field->getType();
            $command->input[$field->slug] = $type->preSaveEvent($command->input[$field->slug]);
        }
        return $next($command);
    }
}
