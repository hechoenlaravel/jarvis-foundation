<?php

namespace Hechoenlaravel\JarvisFoundation\UI\Field;

use JavaScript;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypes;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;
use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

/**
 * Class FormBuilder
 * @package Hechoenlaravel\JarvisFoundation\UI\Field
 */
class FormBuilder
{
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
     * When edit, it should have a model to work with
     * @var
     */
    protected $model;

    /**
     * Is the edit form?
     * @var bool
     */
    protected $isEdit = false;

    /**
     * Field Type
     * @var
     */
    protected $type;

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
     * @param FieldModel $model
     */
    public function setModel(FieldModel $model)
    {
        $this->model = $model;
        $this->isEdit = true;
        $this->type = $this->types->getFieldClass($model->type);
    }

    /**
     * render the form to add the field
     * @return string
     */
    public function render()
    {
        if (!$this->isEdit) {
            $view = view('jarvisPlatform::field.admin.fieldform')
                ->with('entity', $this->entity)
                ->with('returnUrl', $this->url)
                ->with('types', $this->getFieldTypes())
                ->render();
            return $view;
        }
        JavaScript::put([
            'fieldForm' => $this->model->transformed()->toArray()
        ]);
        $view = view('jarvisPlatform::field.admin.fieldformedit')
            ->with('entity', $this->entity)
            ->with('returnUrl', $this->url)
            ->with('fieldAssignmentForm', $this->type->getOptionsForm())
            ->with('types', $this->getFieldTypes())
            ->render();
        return $view;
    }

    /**
     * Get the Field Types
     * @return array
     */
    public function getFieldTypes()
    {
        $types = [];
        foreach ($this->types->types as $type => $class) {
            $c = app($class);
            $types[$type] = $c->name;
        }
        return $types;
    }
}
