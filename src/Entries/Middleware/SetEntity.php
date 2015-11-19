<?php

namespace Hechoenlaravel\JarvisFoundation\Entries\Middleware;

use League\Tactician\Middleware;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Class SetEntity
 * Set the entity model for the entry to be created or updated
 * @package Hechoenlaravel\JarvisFoundation\Entries\Middleware
 */
class SetEntity implements Middleware
{
    /**
     * Execute the Middleware
     * @param object $command
     * @param callable $next
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $command->entity = EntityModel::findOrFail($command->entity);
        return $next($command);
    }
}
