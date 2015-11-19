<?php

namespace Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Events;

use Hechoenlaravel\JarvisFoundation\Events\Event;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Notification;

class NotificationWasOpened extends Event
{
    /**
     * @var Notification
     */
    public $notification;

    /**
     * @param Notification $notification
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }
}
