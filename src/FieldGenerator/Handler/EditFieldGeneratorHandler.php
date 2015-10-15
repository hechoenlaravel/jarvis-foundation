<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler;


use Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasEdited;
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
        $rename = false;
        $oldSlug = $model->slug;
        if($model->slug !== $command->slug){
            $rename = true;
        }
        unset($fields['id']);
        $model->fill($fields);
        $model->save();
        event(new FieldWasEdited($model, $rename, $oldSlug));
        return $model;
    }

}