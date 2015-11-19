<?php

namespace Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification;

/**
 * Class SendAppNotificationCommand
 * Sends an In App notification to a user
 * @package Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification
 */
class SendAppNotificationCommand
{
    /**
     * @var
     */
    public $user;

    /**
     * @var
     */
    public $type;

    /**
     * @var
     */
    public $message;

    /**
     * @var
     */
    public $link;

    /**
     * @param $user
     * @param $type
     * @param $message
     * @param $link
     */
    public function __construct($user, $type, $message, $link = null)
    {
        $this->user = $user;
        $this->type = $type;
        $this->message = $message;
        $this->link = $link;
    }
}
