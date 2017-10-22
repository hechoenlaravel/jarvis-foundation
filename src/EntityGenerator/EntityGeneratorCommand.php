<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator;

/**
 * Class EntityGeneratorCommand
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator
 */
class EntityGeneratorCommand
{
    /**
     * The entity namespace
     * @string
     */
    public $namespace;

    /**
     * The entity name
     * @string
     */
    public $name;

    /**
     * The entity description
     * @string
     */
    public $description;

    /**
     * The entity slug form the table name
     * @string
     */
    public $slug;

    /**
     * The entity database prefix
     * @string
     */
    public $prefix;

    /**
     * Is the entity locked? means it cant be erase
     * @boolean
     */
    public $locked;

    /**
     * Should the command create the DB table?
     * @boolean
     */
    public $create_table;

    /**
     * is there a table name defined?
     * @boolean
     */
    public $table_name;


    /**
     * @param string $namespace
     * @param string $name
     * @param string $description
     * @param string $slug
     * @param string $prefix
     * @param bool $locked
     * @param string $table_name
     */
    public function __construct($namespace = "", $name = "", $description = "", $slug = "", $prefix = "", $locked = true, $create_table = true, $table_name = null)
    {
        $this->namespace = $namespace;
        $this->name = $name;
        $this->description = $description;
        $this->slug = $slug;
        $this->prefix = $prefix;
        $this->locked = $locked;
        $this->create_table = $create_table;
        $this->table_name = $table_name;
    }
}
