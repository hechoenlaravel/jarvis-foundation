<?php

namespace Hechoenlaravel\JarvisFoundation\Field;


/**
 * Interface FieldTypeInterface
 * @package Hechoenlaravel\JarvisFoundation\Field
 */
interface FieldTypeInterface {

    /**
     * Should return the type of column to be created in
     * the database laravel schema builder friendly
     * @return string
     */
    public function getColumnType();

    /**
     * Set the value for the field, any transformation before the
     * value goes to the database should be implemented here
     * @param $value
     * @return mixed
     */
    public function setValue($value);

    /**
     * Get the value for the field
     * @return mixed
     */
    public function getValue();

    /**
     * Get the presenter class if any
     * @return mixed
     */
    public function getPresenter();

}