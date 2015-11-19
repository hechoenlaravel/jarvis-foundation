<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

/**
 * Trait DispatchesCommands
 * Use this trait to dispatch the commands for the Laravel Tactician Command Bus.
 * @author Jose Fonseca <jose@ditecnologia.com>
 * @package Hechoenlaravel\JarvisFoundation\Traits
 */
trait DispatchesCommands
{
    /**
     * Dispatch the Command
     * @param string $command Full namespace class name or bind from the Laravel Service container for the command
     * @param string $handler Full namespace class name or bind from the Laravel Service container form the command handler
     * @param array $input
     * @param array $middleware
     * @return mixed
     */
    public function execute($command, $handler, array $input = [], array $middleware = [])
    {
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler($command, $handler);
        return $bus->dispatch($command, $input, $middleware);
    }
}
