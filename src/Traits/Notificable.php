<?php

namespace Hechoenlaravel\JarvisFoundation\Traits;

use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Middleware\SetTheUserId;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\SendAppNotificationCommand;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Handler\SendAppNotificationCommandHandler;

/**
 * Trait Notificable
 * Use this trait to send notifications to a User.
 * @author Jose Fonseca <jose@ditecnologia.com>
 * @package Hechoenlaravel\JarvisFoundation\Traits
 */
trait Notificable {

    use DispatchesCommands;

    /**
     * @param object $user
     * @param $message
     * @param string $type
     * @param null $link
     */
    public function sendAppNotification($user, $message, $type = "info", $link = null)
    {
        $this->execute(SendAppNotificationCommand::class, SendAppNotificationCommandHandler::class, [
            'user' => $user,
            'type' => $type,
            'message' => $message,
            'link' => $link
        ],[
            SetTheUserId::class
        ]);
    }

}