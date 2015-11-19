<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler;

use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasCreated;

/**
 * Class FieldGeneratorHandler
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler
 */
class CreateFieldCommandHandler
{
    /**
     * Handle the creation of the Field in the Database
     * @param $command
     * @return static
     */
    public function handle($command)
    {
        $command->namespace = EntityModel::find($command->entity_id)->namespace;
        $field = FieldModel::create((array) $command);
        event(new FieldWasCreated($field));
        return $field;
    }
}
