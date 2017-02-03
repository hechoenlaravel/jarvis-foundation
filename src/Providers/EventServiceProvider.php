<?php

namespace Hechoenlaravel\JarvisFoundation\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Hechoenlaravel\JarvisFoundation\EntityGenerator\Events\EntityWasCreated' => [
            'Hechoenlaravel\JarvisFoundation\EntityGenerator\Listeners\CreateTableInDatabase'
        ],
        'Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasCreated' => [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Listeners\CreateColumnInDatabase'
        ],
        'Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasEdited' => [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Listeners\RenameColumn'
        ],
        'Hechoenlaravel\JarvisFoundation\FieldGenerator\Events\FieldWasDeleted' => [
            'Hechoenlaravel\JarvisFoundation\FieldGenerator\Listeners\DeleteColumn'
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
