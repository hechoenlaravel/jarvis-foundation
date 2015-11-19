<?php

namespace Hechoenlaravel\JarvisFoundation\FieldGenerator\Middleware;

use League\Tactician\Middleware;
use Hechoenlaravel\JarvisFoundation\FieldGenerator\FieldModel;

class FieldOrderSetter implements  Middleware
{
    /**
     * @param object $command
     * @param callable $next
     *
     * @return mixed
     */
    public function execute($command, callable $next)
    {
        if (!is_null($command->order)) {
            $this->updateCurrentFields($command);
        } else {
            $command = $this->setOrder($command);
        }
        return $next($command);
    }

    /**
     * If the command has an order, use it and move the ones after that.
     * @param $command
     */
    protected function updateCurrentFields($command)
    {
        FieldModel::where('entity_id', $command->entity_id)
            ->where('order', '>=', $command->order)
            ->orderBy('order', 'ASC')
            ->get()
            ->each(function ($field) {
                $field->order = $field->order + 1;
                $field->save();
            });
    }

    /**
     * Set the order for the field
     * @param $command
     */
    protected function setOrder($command)
    {
        $command->order = 1;
        $lastField = FieldModel::where('entity_id', $command->entity_id)->orderBy('order', 'DESC')->first();
        if (!is_null($lastField)) {
            $command->order = $lastField->order + 1;
        }
        return $command;
    }
}
