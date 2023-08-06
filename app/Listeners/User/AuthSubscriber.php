<?php

namespace Selvah\Listeners\User;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Notification;
use Selvah\Events\Auth\RegisteredEvent;
use Selvah\Notifications\Auth\RegisteredNotification;

class AuthSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            RegisteredEvent::class => 'handleUserRegistered',
        ];
    }

    /**
     * Handle user registered events.
     */
    public function handleUserRegistered(RegisteredEvent $event): void
    {
        $user = $event->user;

        if ($user->hasRole('Saisonnier')) {
            Notification::send($user, new RegisteredNotification($user));
        }
    }
}
