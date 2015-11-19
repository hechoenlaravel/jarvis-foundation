<?php

namespace Hechoenlaravel\JarvisFoundation\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Notification;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Events\NotificationWasReaded;
use Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Events\NotificationWasOpened;

/**
 * Class NotificationsController
 * @package Hechoenlaravel\JarvisFoundation\Http\Controllers
 */
class NotificationsController extends Controller
{
    /**
     * Lists notifications
     * @return $this
     */
    public function index()
    {
        $notifications = Notification::byUser(Auth::user())->orderBy('created_at', 'DESC')->paginate(20);
        return view('jarvisPlatform::notifications.index')->with('notifications', $notifications);
    }

    /**
     * Read a notification
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function read($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification->user_id != Auth::user()->id) {
            abort(403);
        }
        if (empty($notification->readed_at)) {
            $notification->readed_at = Carbon::now();
            $notification->save();
            event(new NotificationWasReaded($notification));
        }
        event(new NotificationWasOpened($notification));
        if (!empty($notification->link)) {
            return redirect()->to($notification->link);
        }
        return redirect()->route('notifications');
    }
}
