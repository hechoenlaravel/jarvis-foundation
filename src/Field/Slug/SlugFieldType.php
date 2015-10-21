<?php

namespace Hechoenlaravel\JarvisFoundation\Field\Slug;

use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeImplementationTrait;

/**
 * Class SlugFieldType
 * @package Hechoenlaravel\JarvisFoundation\Slug\Email
 */
class SlugFieldType implements FieldTypeInterface
{

    use FieldTypeImplementationTrait;

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
    public $name = "Slug";

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
    public function present()
    {
        return;
    }

    /**
     * Que the form for the options of the field type
     * @return mixed
     */
    public function getOptionsForm()
    {
        // TODO: Implement getOptionsForm() method.
    }

    /**
     * Pre Assign Event to do anything the fieldType needs to.
     * @param $command
     */
    public function preAssignEvent($command)
    {
        if(!isset($command->options['separator'])){
            $command->options['separator'] = '-';
        }
    }

}