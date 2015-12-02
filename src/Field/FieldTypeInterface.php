<?php

namespace Hechoenlaravel\JarvisFoundation\Field;

/**
 * Interface FieldTypeInterface
 * @package Hechoenlaravel\JarvisFoundation\Field
 */
interface FieldTypeInterface
{
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
     * present the form
     * @return mixed
     */
    public function present();

    /**
     * Que the form for the options of the field type
     * @return mixed
     */
    public function getOptionsForm();

    /**
     * Generate a Slug based on the name
     * @param $name
     * @return mixed
     */
    public function generateSlug($name);

    /**
     * Runs before the field is assigned
     * @param $command
     * @return mixed
     */
    public function preAssignEvent($command);

    /**
     * Runs before saving to DB
     * @param $value
     * @return mixed
     */
    public function preSaveEvent($value);

    /**
     * Present the value for front
     * @return mixed
     */
    public function presentFront();
}
