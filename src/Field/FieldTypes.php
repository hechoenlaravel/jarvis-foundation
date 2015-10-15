<?php

namespace Hechoenlaravel\JarvisFoundation\Field;


/**
 * Class FieldTypes
 * @package Hechoenlaravel\JarvisFoundation\Field
 */
class FieldTypes {

    /**
     * The field types registred
     * @var array
     */
    public $types = [];


    /**
     * Add a field type to the stack
     * @param $field
     */
    public function addFieldType($field)
    {
        $this->types[$field['type']] = $field['class'];
    }

    public function getFieldClass($type)
    {
        return app($this->types[$type]);
    }

}