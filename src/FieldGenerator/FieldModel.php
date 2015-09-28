<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator;

use Illuminate\Database\Eloquent\Model;

class FieldModel extends Model{

    protected $table = "app_entities_fields";

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
        'create_field'
    ];

    public function entity()
    {
        return $this->belongsTo('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel');
    }

    public function getType()
    {
        $types = app('field.types');
        return app($types->types[$this->type]);
    }

}