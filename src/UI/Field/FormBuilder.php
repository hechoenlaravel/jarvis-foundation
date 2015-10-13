<?php

namespace Hechoenlaravel\JarvisFoundation\UI\Field;


use Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityModel;

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
     * Create a new Object
     * @param EntityModel $entity
     */
    public function __construct(EntityModel $entity)
    {
        $this->entity = $entity;
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
            ->render();
        return $view;
    }

}