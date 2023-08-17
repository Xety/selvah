<?php

namespace Selvah\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Selvah\Listeners\Cleaning\AlertSubscriber as AlertCleaningSubscriber;
use Selvah\Listeners\Part\AlertSubscriber as AlertPartSubscriber;
use Selvah\Listeners\User\AuthSubscriber;
use Selvah\Models\Calendar;
use Selvah\Models\Cleaning;
use Selvah\Models\Incident;
use Selvah\Models\Lot;
use Selvah\Models\Maintenance;
use Selvah\Models\Material;
use Selvah\Models\Part;
use Selvah\Models\PartEntry;
use Selvah\Models\PartExit;
use Selvah\Models\User;
use Selvah\Observers\CalendarObserver;
use Selvah\Observers\CleaningObserver;
use Selvah\Observers\IncidentObserver;
use Selvah\Observers\LotObserver;
use Selvah\Observers\MaintenanceObserver;
use Selvah\Observers\MaterialObserver;
use Selvah\Observers\PartEntryObserver;
use Selvah\Observers\PartExitObserver;
use Selvah\Observers\PartObserver;
use Selvah\Observers\UserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        /*Registered::class => [
            SendEmailVerificationNotification::class,
        ],*/
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        AlertPartSubscriber::class,
        AuthSubscriber::class,
        AlertCleaningSubscriber::class,
    ];

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        User::class => [UserObserver::class],
        Cleaning::class => [CleaningObserver::class],
        PartEntry::class => [PartEntryObserver::class],
        PartExit::class => [PartExitObserver::class],
        Part::class => [PartObserver::class],
        Material::class => [MaterialObserver::class],
        Maintenance::class => [MaintenanceObserver::class],
        Lot::class => [LotObserver::class],
        Incident::class => [IncidentObserver::class],
        Calendar::class => [CalendarObserver::class]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
