<?php

namespace Hechoenlaravel\JarvisFoundation\UI\Field;

use DB;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;


/**
 * Class EntityFieldPresenter
 * @package Hechoenlaravel\JarvisFoundation\UI\Field
 */
class EntityFieldPresenter
{
    /**
     * @var EntityModel
     */
    public $entity;

    /**
     * @var \Illuminate\Foundation\Application|mixed
     */
    protected $typeResolver;

    /**
     * @var array
     */
    protected $types = [];

    /**
     * @var
     */
    protected $entry;

    /**
     * EntityFieldPresenter constructor.
     * @param EntityModel $entity
     */
    public function __construct(EntityModel $entity)
    {
        $this->entity = $entity;
        $this->typeResolver = app('field.types');
        $this->setFieldTypes();
    }

    /**
     * @param $id
     */
    public function setRowId($id, $column = 'id')
    {
        $this->entry = DB::table($this->entity->getTableName())->where($column, $id)->first();
        foreach ($this->types as $field) {
            $field->setValue($this->entry->{$field->fieldSlug});
        }
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->types;
    }

    /**
     * @return $this
     */
    protected function setFieldTypes()
    {
        foreach ($this->entity->fields as $field) {
            $this->types[$field->slug] = $this->typeResolver->getFieldClass($field->type);
            $this->types[$field->slug]->fieldSlug = $field->slug;
            $this->types[$field->slug]->fieldName = $field->name;
            $this->types[$field->slug]->fieldDescription = $field->description;
            $this->types[$field->slug]->fieldOptions = $field->options;
        }
        return $this;
    }
}