<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Listeners;

use Illuminate\Support\Facades\Schema;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\Events\EntityWasCreated;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\Events\TableWasCreatedInDb;

/**
 * Class CreateTableInDatabase
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator\Listeners
 */
class CreateTableInDatabase {

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(EntityWasCreated $event)
    {
        Schema::create($event->entity->table_name, function($table){
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });
        event(new TableWasCreatedInDb($event->entity));
    }

}