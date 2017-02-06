<?php

namespace Hechoenlaravel\JarvisFoundation\Menu;


/**
 * Class MenuService
 * @package Hechoenlaravel\JarvisFoundation\Menu
 */
class MenuService
{

    /**
     * @var array|\Illuminate\Support\Collection
     */
    public $groups = [];

    /**
     * MenuService constructor.
     */
    public function __construct()
    {
        $this->groups = collect();
    }

    /**
     * @param $class
     */
    public function addMenuDefinition($class)
    {
        if(class_exists($class)) {
            $this->groups->push($class);
        }
    }

    /**
     * @param string $group
     * @return mixed
     */
    public function render($group = 'sidebar')
    {
        $this->groups->each(function($class){
            $definition = app($class);
            $menu = app('menu')->instance($definition->getInstance());
            if($definition->isDropdown()) {
                $menu->dropdown($definition->getName(), function($sub) use ($definition) {
                    $definition->items->each(function($item) use ($sub) {
                        if($item['type'] == 'route') {
                            $sub->route($item['route'], $item['name'], [], 0, ['active' => $item['active-state']])
                                ->hideWhen($item['ability']);
                        }
                        if($item['type'] == 'header') {
                            $sub->addHeader($item['name']);
                        }
                        if($item['type'] == 'url') {
                            $sub->url($item['url'], $item['name'], 0, ['active' => $item['active-state']])
                                ->hideWhen($item['ability']);;
                        }
                    });
                });
            } else {
                $definition->items->each(function($item) use ($menu) {
                    if($item['type'] == 'route') {
                        $menu->route($item['route'], $item['name'], [], 0, ['active' => $item['active-state']])
                            ->hideWhen($item['ability']);
                    }
                    if($item['type'] == 'header') {
                        $menu->addHeader($item['name']);
                    }
                    if($item['type'] == 'url') {
                        $menu->url($item['url'], $item['name'], 0, ['active' => $item['active-state']])
                            ->hideWhen($item['ability']);;
                    }
                });
            }
        });
        return app('menu')->render($group);
    }

}