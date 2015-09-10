<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator;

use Illuminate\Database\Eloquent\Model;

class EntityModel extends Model{

    protected $table = "app_entities";

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

}