<?php

namespace Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification
 */
class Notification extends Model{

    /**
     * @var string
     */
    protected $table = "app_notifications";

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'type', 'message', 'link', 'readed_at'];

    /**
     * Filter by User
     * @param $query
     * @param $user
     * @return mixed
     */
    public function scopeByUser($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    /**
     * Filter the Unread Ones
     * @param $query
     */
    public function scopeUnread($query)
    {
        $query->where('readed_at');
    }

    public function getTimeAgo()
    {
        return $this->created_at->diffForHumans();
    }

    public function getLink()
    {
        return '#';
    }

}