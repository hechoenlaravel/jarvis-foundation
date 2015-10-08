<?php

namespace Hechoenlaravel\JarvisFoundation\Field\Email;

use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;

/**
 * Class EmailFieldType
 * @package Hechoenlaravel\JarvisFoundation\Field\Email
 */
class EmailFieldType implements FieldTypeInterface
{

    /**
     * @var
     */
    private $value;

    /**
     * @var string
     */
    protected $columnType = "string";

    /**
     * get the column type for this field type
     * @return string
     */
    public function getColumnType()
    {
        return $this->columnType;
    }

    /**
     * Set a value for this field;
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * get the value for the field
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the presenter class if any
     * @return mixed
     */
    public function getPresenter()
    {
        return;
    }
}