<?php

namespace Hechoenlaravel\JarvisFoundation\Tests\Notifications;

use Hechoenlaravel\JarvisFoundation\Tests\Stubs\UserModel;
use Hechoenlaravel\JarvisFoundation\Tests\TestCase;

class TestNotifications extends TestCase
{

    /**
     * It can send a notification to a User
     * @test
     */
    public function it_sends_notification_to_user()
    {
        $this->migrateDatabase();
        $this->createUser();
        $user = UserModel::first();
        $bus = app('Joselfonseca\LaravelTactician\CommandBusInterface');
        $bus->addHandler('Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\SendAppNotificationCommand',
            'Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Handler\SendAppNotificationCommandHandler');
        $bus->dispatch('Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\SendAppNotificationCommand', [
            'user' => $user,
            'type' => 'success',
            'message' => 'Some Message'
        ],
            [
                'Hechoenlaravel\JarvisFoundation\Notifications\SendAppNotification\Middleware\SetTheUserId'
            ]);
        $this->assertDatabaseHas('app_notifications', [
            'user_id' => $user->id,
            'type' => 'success',
            'message' => 'Some Message'
        ]);
    }

}