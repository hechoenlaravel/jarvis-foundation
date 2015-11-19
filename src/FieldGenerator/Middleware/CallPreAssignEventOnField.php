<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use League\Tactician\Middleware;

class CallPreAssignEventOnField implements Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        $fieldType = $this->setFieldType($command->type);
        $fieldType->preAssignEvent($command);
        return $next($command);
    }

    /**
     * @param $type
     * @return \Illuminate\Foundation\Application|mixed
     * @throws \NotAcceptableHttpException
     */
    private function setFieldType($type)
    {
        $fieldTypes = app('field.types');
        return $fieldTypes->getFieldClass($type);
    }
}
