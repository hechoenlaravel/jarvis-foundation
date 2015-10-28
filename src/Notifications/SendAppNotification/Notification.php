<?php

namespace Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model{

    protected $table = "app_notifications";

    protected $fillable = ['user_id', 'type', 'message', 'link', 'readed_at'];

}