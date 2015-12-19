<?php

namespace Hechoenlaravel\JarvisFoundation\UI\Field;

use DB;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Builds the fields HTML for a form
 * Class EntityFieldsFormBuilder
 * @package Hechoenlaravel\JarvisFoundation\UI\Field
 */
class EntityFieldsFormBuilder
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
     * @var array
     */
    protected $presenters = [];

    /**
     * @param EntityModel $entity
     */
    public function __construct(EntityModel $entity)
    {
        $this->entity = $entity;
        $this->typeResolver = app('field.types');
        $this->setFieldTypes();
    }

    public function setRowId($id, $column = "id")
    {
        $this->entry = DB::table($this->entity->getTableName())->where($column, $id)->first();
        foreach ($this->types as $field) {
            $field->setValue($this->entry->{$field->fieldSlug});
        }
    }

    /**
     * @return $this
     */
    public function render()
    {
        return view('jarvisPlatform::field.form')
            ->with('fields', $this->types);
    }

    /**
     * @return $this
     */
    protected function setFieldTypes()
    {
        $i = 0;
        foreach ($this->entity->fields as $field) {
            $this->types[$i] = $this->typeResolver->getFieldClass($field->type);
            $this->types[$i]->fieldSlug = $field->slug;
            $this->types[$i]->fieldName = $field->name;
            $this->types[$i]->fieldDescription = $field->description;
            $this->types[$i]->fieldOptions = $field->options;
            $i++;
        }

        return $this;
    }
}
