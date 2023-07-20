<?php

namespace Selvah\Listeners\Part;

use Illuminate\Contracts\Queue\ShouldQueue;
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
     * The events mapping to the listener function.
     *
     * @var array
     */
    protected $events = [
        AlertEvent::class => 'handleAlert',
        CriticalAlertEvent::class => 'handleCriticalAlert',
    ];

    /**
     * Register the listeners for the subscriber.
     *
     * @param Illuminate\Events\Dispatcher $events
     *
     * @return void
     */
    public function subscribe($events)
    {
        foreach ($this->events as $event => $action) {
            $events->listen($event, AlertSubscriber::class . '@' . $action);
        }
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
            $q->whereIn("name", ["Administrateur","Responsable Prod",'Responsable Prod Adjoint']);
        })->get();

        Notification::send($users, new AlertNotification($part, $critical));

        return true;
    }
}
