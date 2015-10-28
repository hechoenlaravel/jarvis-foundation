<?php

namespace Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Handler;


use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Notification;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Events\NotificationWasSent;

class SendAppNotificationCommandHandler {

    public function handle($command)
    {
        $notification = Notification::create((array) $command);
        event(new NotificationWasSent($notification));
        return $notification;
    }

}