<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator;


/**
 * Class EditFieldGeneratorCommand
 * @package Hechoenlaravel\JarvisFoundation\FieldGenerator
 */
class EditFieldCommand {

    /**
     * The field Id
     * @var
     */
    public $id;

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
     * @param $id
     * @param string $name
     * @param string $description
     * @param bool $required
     * @param array $options
     * @param null $default
     */
    public function __construct(
        $id,
        $name = "",
        $description = "",
        $required = false,
        $options = [],
        $default = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->required = $required;
        $this->options = $options;
        $this->default = $default;
    }

}