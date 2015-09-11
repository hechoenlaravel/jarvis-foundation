<?php

namespace Hechoenlaravel\JarvisFoundation\Field;


/**
 * Interface FieldInterface
 * @package Hechoenlaravel\JarvisFoundation\Field
 */
interface FieldInterface {

    /**
     * Generate a Slug based on the name
     * @param $name
     * @return mixed
     */
    public function generateSlug($name);

    /**
     * Set the field type for this field
     * @param FieldTypeInterface $type
     * @return mixed
     */
    public function setType(FieldTypeInterface $type);


}