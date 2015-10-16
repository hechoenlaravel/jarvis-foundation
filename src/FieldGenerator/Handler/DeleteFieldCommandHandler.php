<?php


namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler;

use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasDeleted;

class DeleteFieldCommandHandler
{
    public function handle($command)
    {
        $model = FieldModel::find($command->id);
        $modelArray = $model->toArray();
        $model->delete();
        event(new FieldWasDeleted($modelArray));
    }
}