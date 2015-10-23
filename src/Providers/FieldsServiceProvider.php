<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class FieldsServiceProvider
 * @package Hechoenlaravel\JarvisFoundation\Providers
 */
class FieldsServiceProvider extends ServiceProvider{

    /**
     * The system Field types
     * @var array
     */
    public $defaultTypes = [
        'text' => \Hechoenlaravel\JarvisFoundation\Field\Text\TextFieldType::class,
        'email' => \Hechoenlaravel\JarvisFoundation\Field\Email\EmailFieldType::class,
        'textarea' => \Hechoenlaravel\JarvisFoundation\Field\TextArea\TextAreaFieldType::class,
        'hidden' => \Hechoenlaravel\JarvisFoundation\Field\Hidden\HiddenFieldType::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('field.types', 'Hechoenlaravel\JarvisFoundation\Field\FieldTypes');
        $this->setDefaultTypes();
    }

    /**
     * Set the default Field Types
     */
    public function setDefaultTypes()
    {
        $types = $this->app->make('field.types');
        foreach($this->defaultTypes as $alias => $fieldType)
        {
            $types->addFieldType([
                'type' => $alias,
                'class' => $fieldType
            ]);
        }
    }
}