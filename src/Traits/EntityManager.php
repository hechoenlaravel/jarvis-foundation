<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

/**
 * Trait EntityManager
 * Use it to Manage Entities and fields in your classes
 * @author Jose Luis Fonseca <jose@ditecnologia.com>
 * @package Hechoenlaravel\JarvisFoundation\Traits
 */
trait EntityManager
{
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
        return $this->execute('Hechoenlaravel\JarvisFoundation\FieldGenerator\CreateFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\CreateFieldCommandHandler', $data, [
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldGeneratorValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldTypeValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOrderSetter',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
            ]);
    }

    /**
     * Edit a field
     * @param array $data
     * @return mixed
     */
    public function editField(array $data = [])
    {
        return $this->execute('Hechoenlaravel\JarvisFoundation\FieldGenerator\EditFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\EditFieldCommandHandler', $data, [
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\EditFieldTypeValidator',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CreateTheFieldSlug',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\SetFieldTypeOnEdit',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\SetCommandDataFromEditFieldModel',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\CallPreAssignEventOnField',
                'Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware\FieldOptionsSerializer',
            ]);
    }

    /**
     * Delete a Field
     * @param $id
     * @return mixed
     */
    public function deleteField($id)
    {
        return $this->execute('Hechoenlaravel\JarvisFoundation\FieldGenerator\DeleteFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\DeleteFieldCommandHandler', [
            'id' => $id
        ]);
    }

    /**
     * Re order from a field
     * @param $id
     * @param $order
     * @return mixed
     */
    public function reOrderField($items)
    {
        return $this->execute('Hechoenlaravel\JarvisFoundation\FieldGenerator\ReOrderFieldCommand',
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Handler\ReOrderFieldCommandHandler', [
                'fields' => $items
            ]);
    }
}
