<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware;

use League\Tactician\Middleware;

/**
 * Sets the prefix and table name for the table creation
 * Class SetPrefixAndTableName
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware
 */
class SetPrefixAndTableName implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $command->prefix = $this->setPrefix($command);
        $command->table_name = $this->getTableName($command);
        return $next($command);
    }


    /**
     * Set the entity prefix
     * @param $command
     * @return mixed
     */
    protected function setPrefix($command)
    {
        if (empty($command->prefix) && empty($command->namespace)) {
            return null;
        }
        if (empty($command->prefix) && !empty($command->namespace)) {
            return $command->namespace;
        }
        return $command->prefix;
    }


    /**
     * set the entity table name
     * @param $command
     * @return string
     */
    protected function getTableName($command)
    {
        if(!empty($command->table_name)) {
            return $command->table_name;
        }
        if(empty($command->prefix)) {
            return $command->slug;
        }
        return $command->prefix.'_'.$command->slug;
    }
}
