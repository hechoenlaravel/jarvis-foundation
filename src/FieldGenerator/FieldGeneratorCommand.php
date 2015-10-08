<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator;

/**
 * Class FieldGeneratorCommand
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator
 */
class FieldGeneratorCommand
{

    /**
     * The entity related to the field
     * @var
     */
    public $entity_id;

    /**
     * The field namespace
     * @var
     */
    public $namespace;

    /**
     * the field name
     * @var
     */
    public $name;

    /**
     * The field description
     * @var
     */
    public $description;

    /**
     * the field Slug
     * @var
     */
    public $slug;

    /**
     * is the field locked? meaning cant be removed
     * @var
     */
    public $locked;

    /**
     * Should the field be created in the DB table
     * @var
     */
    public $create_field;

    /**
     * what is the fieldtype
     * @var
     */
    public $type;

    /**
     * is the field required?
     * @var
     */
    public $required;

    /**
     * The field options
     * @var
     */
    public $options;

    /**
     * The field default value
     * @var
     */
    public $default;

    /**
     * is a hidden field?
     * @var
     */
    public $hidden;

    /**
     * @param string $entity_id
     * @param string $namespace
     * @param string $name
     * @param string $description
     * @param string $slug
     * @param bool $locked
     * @param bool $create_field
     * @param string $type
     */
    function __construct(
        $entity_id = "",
        $namespace = "",
        $name = "",
        $description = "",
        $slug = "",
        $locked = true,
        $create_field = true,
        $type = "",
        $required = false,
        $options = [],
        $default = null,
        $hidden = 0
    ) {
        $this->entity_id = $entity_id;
        $this->namespace = $namespace;
        $this->name = $name;
        $this->description = $description;
        $this->slug = $slug;
        $this->locked = $locked;
        $this->create_field = $create_field;
        $this->type = $type;
        $this->required = $required;
        $this->options = $options;
        $this->default = $default;
        $this->hidden = $hidden;
    }

}