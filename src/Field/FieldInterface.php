<?php

namespace Hechoenlaravel\JarvisFoundation\Field;


/**
 * Interface FieldInterface
 * @package Hechoenlaravel\JarvisFoundation\Field
 */
interface FieldInterface {

    /**
     * Set the field type for this field
     * @param FieldTypeInterface $type
     * @return mixed
     */
    public function setType(FieldTypeInterface $type);


}