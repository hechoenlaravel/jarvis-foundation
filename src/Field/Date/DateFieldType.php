<?php

namespace Hechoenlaravel\JarvisFoundation\Field\Date;

use Carbon\Carbon;
use Styde\Html\Facades\Field;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeImplementationTrait;

class DateFieldType implements FieldTypeInterface
{
    use FieldTypeImplementationTrait;

    /**
     * @var
     */
    private $value;

    /**
     * @var string
     */
    protected $columnType = "date";

    /**
     * The field type name
     * @var string
     */
    public $name = "Fecha";

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
    public $validationRules = ['date'];

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
        $date = null;
        if(!empty($this->value)){
            $date = Carbon::createFromTimestamp(strtotime($this->value));
        }
        return Field::text($this->fieldSlug, empty($date) ? null : $date->format('m/d/Y'), ['label' => $this->fieldName, 'class' => 'datepicker']);
    }

    /**
     * Que the form for the options of the field type
     * @return mixed
     */
    public function getOptionsForm()
    {
        return view('jarvisPlatform::field.types.date.optionsForm')->render();
    }

    /**
     * Take the value and capitalize the first letter.
     * @param $value
     * @return string
     */
    public function preSaveEvent($value)
    {
        $date = Carbon::createFromTimestamp(strtotime($value));
        return $date->format('Y-m-d');
    }

    /**
     * @return mixed
     */
    public function presentFront()
    {
        $date = Carbon::createFromTimestamp(strtotime($this->value));
        return $date->format('m/d/Y');
    }

}