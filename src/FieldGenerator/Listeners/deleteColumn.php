<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Listeners;

use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasDeleted;
use Illuminate\Support\Facades\Schema;

class DeleteColumn
{
    public function handle(FieldWasDeleted $event)
    {
        $field = $event->field;
        $entity = EntityModel::find($field['entity_id']);
        Schema::table($entity->getTableName(), function ($table) use ($field) {
            $table->dropColumn($field['slug']);
        });
    }
}
