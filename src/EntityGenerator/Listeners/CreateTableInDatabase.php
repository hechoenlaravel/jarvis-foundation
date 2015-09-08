<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Listeners;

use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\Events\EntityWasCreated;
use Illuminate\Support\Facades\Schema;

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
        $prefix = $this->setPrefix($event->entity);
        $tableName = $this->getTableName($prefix, $event->entity);
        Schema::create($tableName, function($table){
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * @param EntityModel $entity
     * @return mixed
     */
    protected function setPrefix(EntityModel $entity)
    {
        if(empty($entity->prefix)){
            return $entity->namespace;
        }
        return $entity->prefix;
    }

    /**
     * @param $prefix
     * @param EntityModel $entity
     * @return string
     */
    protected function getTableName($prefix, EntityModel $entity)
    {
        return $prefix.'_'.$entity->slug;
    }

}