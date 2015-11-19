<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler;

use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;

/**
 * Class ReOrderFieldCommandHandler
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler
 */
class ReOrderFieldCommandHandler
{
    /**
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $order = 1;
        foreach ($command->fields as $field) {
            $f = FieldModel::find($field);
            $f->order = $order;
            $f->save();
            $order++;
        }
        return $field;
    }
}
