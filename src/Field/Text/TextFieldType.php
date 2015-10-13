<?php

namespace Hechoenlaravel\JarvisFoundation\Field\Text;

use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;

/**
 * Class TextFieldType
 * @package Hechoenlaravel\JarvisFoundation\Field\Text
 */
class TextFieldType implements FieldTypeInterface
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
     * The field type name
     * @var string
     */
    public $name = "Texto";

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