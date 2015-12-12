<?php

namespace Hechoenlaravel\JarvisFoundation\Observers;

use Uuid;

/**
 * Class UuidObserver
 * Generate Uuid on creation of a resource
 * @package Hechoenlaravel\JarvisFoundation\Observers
 */
class UuidObserver
{
    /**
     * @param $model
     * @throws \Exception
     */
    public function creating($model)
    {
        $model->uuid = Uuid::generate(4);
    }
}