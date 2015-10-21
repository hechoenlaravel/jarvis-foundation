<?php

namespace Hechoenlaravel\JarvisFoundation\Field;


/**
 * Trait FieldTypeImplementationTrait
 * @package Hechoenlaravel\JarvisFoundation\Field
 */
trait FieldTypeImplementationTrait {

    /**
     * Gererate a slug based on name or other parameter
     * @param $name
     * @return string
     */
    public function generateSlug($name)
    {
        return str_slug($name);
    }

    /**
     * Pre Assign Event to do anything the fieldType needs to.
     * @param $command
     */
    public function preAssignEvent($command)
    {

    }

    /**
     * By default wont do anything before saving
     * @param $value
     * @return mixed
     */
    public function preSaveEvent($value)
    {
        return $value;
    }

}