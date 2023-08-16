<?php

namespace Selvah\Listeners\Cleaning;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Selvah\Events\Cleaning\AlertEvent;
use Selvah\Models\Material;
use Selvah\Models\User;
use Selvah\Notifications\Cleaning\AlertNotification;

class AlertSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param Dispatcher $events
     *
     * @return array
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            AlertEvent::class => 'handleAlert'
        ];
    }

    /**
     * Handle cleaning alert events.
     *
     * @param AlertEvent $event
     *
     * @return bool
     */
    public function handleAlert(AlertEvent $event): bool
    {
        $material = $event->material;

        $this->sendNotifications($material);

        // Update the alert send date.
        $material->last_cleaning_alert_send_at = now();
        $material->save();

        return true;
    }

    /**
     * Send notifications (database and email) to the users for the given rôles.
     *
     * @param Material $material
     *
     * @return bool
     */
    protected function sendNotifications(Material $material): bool
    {
        $users = User::with("roles")->whereHas("roles", function ($q) {
            $q->whereIn("name", ["Administrateur","Assistant(e) Qualité"]);
        })->get();

        Notification::send($users, new AlertNotification($material));

        return true;
    }
}
