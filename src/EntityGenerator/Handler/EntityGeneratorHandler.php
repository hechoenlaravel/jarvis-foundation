<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler;

use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\Events\EntityWasCreated;

/**
 * Class EntityGeneratorHandler
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler
 */
class EntityGeneratorHandler
{
    /**
     * Creates the Entity Record
     * @param $command
     * @return static
     */
    public function handle($command)
    {
        $entity = EntityModel::create((array) $command);
        event(new EntityWasCreated($entity));
        return $entity;
    }
}
