<?php

namespace Hechoenlaravel\JarvisFoundation\Field\Select;

use Styde\Html\Facades\Field;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeImplementationTrait;

/**
 * Class SelectFieldType
 * @package Hechoenlaravel\JarvisFoundation\Field\Text
 */
class SelectFieldType implements FieldTypeInterface
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
    public $name = "Lista de selección";

    /**
     * The field slug for the instance
     * @var
     */
    public $fieldSlug;

    /**
     * The field Name for the instance
     * @var
     */
    public $fieldName;

    /**
     * The field description for the instance
     * @var
     */
    public $fieldDescription;

    /**
     * The field Options for the Instance
     * @var
     */
    public $fieldOptions;

    /**
     * Validation rules for the field type
     * @var array
     */
    public $validationRules = [''];

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
     * return the form view
     * @return mixed
     */
    public function present()
    {
        $options = [];
        foreach(unserialize($this->fieldOptions) as $o)
        {
            $options[$o] = $o;
        }
        return Field::select($this->fieldSlug, $options , $this->value, ['label' => $this->fieldName, 'class' => 'select2']);
    }

    /**
     * Que the form for the options of the field type
     * @return mixed
     */
    public function getOptionsForm()
    {
        return view('jarvisPlatform::field.types.select.optionsForm')->render();
    }
}
