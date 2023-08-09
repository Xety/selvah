<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Calendar;

class CalendarObserver
{
    /**
     * Handle the Calendar "creating" event.
     */
    public function creating(Calendar $calendar): void
    {
        $calendar->user_id = Auth::id();
    }
}
