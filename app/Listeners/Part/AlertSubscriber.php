<?php

namespace Selvah\Listeners\Part;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use RuntimeException;
use Selvah\Events\Part\AlertEvent;
use Selvah\Events\Part\CriticalAlertEvent;
use Selvah\Models\Part;
use Selvah\Models\User;
use Selvah\Notifications\Part\AlertNotification;

class AlertSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            AlertEvent::class => 'handleAlert',
            CriticalAlertEvent::class => 'handleCriticalAlert',
        ];
    }

    /**
     * Handle part alert events.
     */
    public function handleAlert(AlertEvent $event)
    {
        $partExit = $event->partExit;

        $part = Part::where('id', $partExit->part_id)->first();

        if ($part->number_warning_minimum >= $part->stock_total) {
            return $this->sendNotifications($part);
        }

        return false;
    }

    /**
     * Handle part alert events.
     */
    public function handleCriticalAlert(CriticalAlertEvent $event)
    {
        $partExit = $event->partExit;

        $part = Part::where('id', $partExit->part_id)->first();

        if ($part->number_critical_minimum >= $part->stock_total) {
            return $this->sendNotifications($part, true);
        }

        return false;
    }

    /**
     *
     * @param Part $part
     *
     * @return void
     *
     * @throws RuntimeException
     */
    protected function sendNotifications(Part $part, $critical = false): bool
    {
        $users = User::with("roles")->whereHas("roles", function ($q) {
            $q->whereIn("name", ["Administrateur","Responsable Prod","Responsable Prod Adjoint"]);
        })->get();

        Notification::send($users, new AlertNotification($part, $critical));

        return true;
    }
}
