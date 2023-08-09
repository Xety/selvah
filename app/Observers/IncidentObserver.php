<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Incident;

class IncidentObserver
{
    /**
     * Handle the Incident "creating" event.
     */
    public function creating(Incident $incident): void
    {
        $incident->user_id = Auth::id();
    }

    /**
     * Handle the Incident "updating" event.
     */
    public function updating(Incident $incident): void
    {
        $incident->is_edited = true;
        $incident->edit_count++;
        $incident->edited_user_id = Auth::id();
    }
}
