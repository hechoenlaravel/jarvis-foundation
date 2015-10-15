<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler;


use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;

class EditFieldGeneratorHandler {

    /**
     * Handle the creation of the Field in the Database
     * @param $command
     * @return static
     */
    public function handle($command)
    {
        $fields = (array) $command;
        $model = FieldModel::find($command->id);
        unset($fields['id']);
        $model->fill($fields);
        $model->save();
        return $model;
    }

}