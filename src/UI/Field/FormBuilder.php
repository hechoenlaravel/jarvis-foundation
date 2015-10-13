<?php

namespace Hechoenlaravel\JarvisFoundation\UI\Field;


use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypes;

/**
 * Class FormBuilder
 * @package Hechoenlaravel\JarvisFoundation\UI\Field
 */
class FormBuilder {

    /**
     * The entity the field is being created for
     * @var EntityModel
     */
    protected $entity;

    /**
     * URL to return to
     * @var
     */
    protected $url;

    /**
     * Field Types
     * @var FieldTypes
     */
    protected $types;

    /**
     * Create a new Object
     * @param EntityModel $entity
     */
    public function __construct(EntityModel $entity)
    {
        $this->entity = $entity;
        $this->types = app('field.types');
    }

    /**
     * set the return URL after the post
     * @param bool $url
     */
    public function setReturnUrl($url = false)
    {
        $this->url = $url;
    }

    /**
     * render the form to add the field
     * @return string
     */
    public function render()
    {
        $view = view('jarvisPlatform::field.admin.fieldform')
            ->with('entity', $this->entity)
            ->with('returnUrl', $this->url)
            ->with('types', $this->getFieldTypes())
            ->render();
        return $view;
    }

    public function getFieldTypes()
    {
        $types = [];
        foreach($this->types->types as $type => $class)
        {
            $c = app($class);
            $types[$type] = $c->name;
        }
        return $types;
    }

}