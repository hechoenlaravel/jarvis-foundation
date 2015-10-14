<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;


/**
 * Trait EntityManager
 * Use it to Manage Entities and fields in your classes
 * @author Jose Luis Fonseca <jose@ditecnologia.com>
 * @package Hechoenlaravel\JarvisFoundation\Traits
 */
trait EntityManager {

    use DispatchesCommands;

    /**
     * Generate an entity
     * @param array $data
     * @return mixed
     */
    public function generateEntity(array $data = [])
    {
        return $this->execute('Hechoenlaravel\JarvisFoundation\EntityGenerator\EntityGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Handler\EntityGeneratorHandler', $data, [
                'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\EntityGeneratorValidator',
                'Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware\SetPrefixAndTableName'
            ]);
    }

    /**
     * Generate a field for an entity
     * @param array $data
     * @return mixed
     */
    public function generateField(array $data = [])
    {
        return $this->execute('Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldGeneratorCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\FieldGeneratorHandler', $data, [
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
            ]);
    }

}