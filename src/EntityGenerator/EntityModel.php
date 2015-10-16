<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EntityModel
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator
 */
class EntityModel extends Model{

    /**
     * @var string
     */
    protected $table = "app_entities";

    /**
     * @var array
     */
    protected $fillable = [
        'namespace',
        'name',
        'slug',
        'description',
        'prefix',
        'table_name',
        'locked',
        'create_table'
    ];

    /**
     * Get the Table name for the Entity
     * @return string
     */
    public function getTableName()
    {
        return $this->prefix.'_'.$this->slug;
    }

    public function fields()
    {
        return $this->hasMany('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel', 'entity_id');
    }

}