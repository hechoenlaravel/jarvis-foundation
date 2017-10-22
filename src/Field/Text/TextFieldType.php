<?php

namespace Hechoenlaravel\JarvisFoundation\Field\Text;

use Styde\Html\Facades\Field;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeInterface;
use Hechoenlaravel\JarvisFoundation\Field\FieldTypeImplementationTrait;

/**
 * Class TextFieldType
 * @package Hechoenlaravel\JarvisFoundation\Field\Text
 */
class TextFieldType implements FieldTypeInterface
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
    public $name = "Texto";

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
    public $validationRules = ['string'];

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
        return Field::text($this->fieldSlug, $this->value, ['label' => $this->fieldName]);
    }

    /**
     * Que the form for the options of the field type
     * @return mixed
     */
    public function getOptionsForm()
    {
        return view('jarvisPlatform::field.types.text.optionsForm')->render();
    }

    /**
     * Take the value and capitalize the first letter.
     * @param $value
     * @return string
     */
    public function preSaveEvent($value)
    {
        return mb_strtolower($value);
    }

    /**
     * @return mixed
     */
    public function presentFront()
    {
        $options = unserialize($this->fieldOptions);
        foreach($options as $option) {
            if(array_key_exists('transform', $option)) {
                return $this->transformText($option['transform']);
            }
        }
        return strtoupper($this->value);
    }

    /**
     * @param $transformation
     * @return string
     */
    protected function transformText($transformation)
    {
        switch ($transformation){
            case "1":
                return mb_strtoupper($this->value);
            case "2":
                return mb_strtolower($this->value);
            case "3":
                return ucwords($this->value);
            default:
                return $this->value;
        }
    }
}
