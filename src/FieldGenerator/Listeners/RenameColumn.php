<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Listeners;

use Illuminate\Support\Facades\Schema;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasEdited;

class RenameColumn {

    /**
     * Once the field has been edited in the DB Record
     * The column in the entity table will be edited.
     * @param FieldWasCreated $event
     */
    public function handle(FieldWasEdited $event)
    {
        $field = $event->field;
        $rename = $event->rename;
        $oldSlug = $event->oldSlug;
        Schema::table($event->field->entity->getTableName(), function($table) use($field, $rename, $oldSlug){
            if($rename){
                $table->renameColumn($oldSlug, $field->slug);
            }
        });
        Schema::table($event->field->entity->getTableName(), function($table) use($field){
            $table->{$field->getType()->getColumnType()}($field->slug)->nullable()->default($field->default)->change();
        });
    }

}