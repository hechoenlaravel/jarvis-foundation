<?php

namespace Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware;

use League\Tactician\Middleware;

/**
 * Sets the prefix and table name for the table creation
 * Class SetPrefixAndTableName
 * @package Hechoenlaravel\JarvisFoundation\EntityGenerator\Middleware
 */
class SetPrefixAndTableName implements Middleware{

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
     * @param EntityModel $entity
     * @return mixed
     */
    protected function setPrefix($command)
    {
        if(empty($command->prefix)){
            return $command->namespace;
        }
        return $command->prefix;
    }

    /**
     * @param $prefix
     * @param EntityModel $entity
     * @return string
     */
    protected function getTableName($command)
    {
        return $command->prefix.'_'.$command->slug;
    }
}