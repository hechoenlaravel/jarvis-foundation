<?php

namespace Hechoenlaravel\JarvisFoundation\UI\Field;

use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

class EntityFieldsFormBuilder
{

    public $entity;

    protected $typeResolver;

    protected $types = [];

    protected $presenters = [];

    public function __construct(EntityModel $entity)
    {
        $this->entity = $entity;
        $this->typeResolver = app('field.types');
    }

    public function render()
    {
        $this->setFieldTypes();
        return view('jarvisPlatform::field.form')->with('fields', $this->types);
    }

    protected function setFieldTypes()
    {
        $i = 0;
        foreach($this->entity->fields as $field){
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