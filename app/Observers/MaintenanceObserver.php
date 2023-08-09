<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Maintenance;

class MaintenanceObserver
{
    /**
     * Handle the Maintenance "creating" event.
     */
    public function creating(Maintenance $maintenance): void
    {
        $maintenance->user_id = Auth::id();
    }

    /**
     * Handle the Maintenance "updating" event.
     */
    public function updating(Maintenance $maintenance): void
    {
        $maintenance->is_edited = true;
        $maintenance->edit_count++;
        $maintenance->edited_user_id = Auth::id();
    }
}
