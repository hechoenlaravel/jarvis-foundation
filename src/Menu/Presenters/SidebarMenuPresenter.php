<?php

namespace Hechoenlaravel\JarvisFoundation\Menu\Presenters;

use Pingpong\Menus\Presenters\Bootstrap\NavbarPresenter;

class SidebarMenuPresenter extends NavbarPresenter
{
    /**
     * {@inheritdoc}
     */
    public function getOpenTagWrapper()
    {
        return PHP_EOL . '<ul class="sidebar-menu">' . PHP_EOL;
    }

    /**
     * {@inheritdoc}
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '
      		<li class="treeview' . $this->getActiveStateOnChild($item, ' active') . '">
                <a href="#">
                    ' . $item->getIcon() . '
                    <span>' . $item->title . '</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    ' . $this->getChildMenuItems($item) . '
                </ul>
            </li>';
    }

    /**
     * {@inheritdoc }.
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li'.$this->getActiveState($item).'><a href="'.$item->getUrl().'" '.$item->getAttributes().'>'.$item->getIcon().' <span>'.$item->title.'</span></a></li>'.PHP_EOL;
    }

    /**
     * {@inheritdoc }.
     */
    public function getMultiLevelDropdownWrapper($item)
    {
        return '<li class="'.$this->getActiveStateOnChild($item, ' active').'">
		          <a href="#">
					'.$item->getIcon().' '.$item->title.'
			      	<i class="fa fa-angle-left pull-right"></i>
			      </a>
			      <ul class="treeview-menu">
			      	'.$this->getChildMenuItems($item).'
			      </ul>
		      	</li>'
        .PHP_EOL;
    }
}
