<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator;

use Hechoenlaravel\JarvisFoundation\FieldGenerator\Transformers\FieldTransformer;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

/**
 * Class FieldModel
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator
 */
class FieldModel extends Model{

    /**
     * database Table
     * @var string
     */
    protected $table = "app_entities_fields";

    /**
     * Fillable columns
     * @var array
     */
    protected $fillable = [
        'entity_id',
        'namespace',
        'name',
        'slug',
        'description',
        'type',
        'default',
        'required',
        'locked',
        'create_field',
        'options',
        'order'
    ];

    /**
     * Related entity
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel');
    }

    /**
     * Returns a FieldType Class for the field
     * @return \Illuminate\Foundation\Application|mixed
     */
    public function getType()
    {
        $types = app('field.types');
        return app($types->types[$this->type]);
    }

    /**
     * Filter By Entity ID
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeByEntity($query, $id)
    {
        return $query->where('entity_id', $id);
    }

    /**
     * Return a Fractal Scope Intance for the model.
     * @return \League\Fractal\Scope
     */
    public function transformed()
    {
        $manager = new Manager();
        $resource = new Item($this, new FieldTransformer());
        return $manager->createData($resource);
    }

}