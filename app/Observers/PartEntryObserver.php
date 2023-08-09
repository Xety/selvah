<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\PartEntry;

class PartEntryObserver
{
    /**
     * Handle the PartEntry "creating" event.
     */
    public function creating(PartEntry $partEntry): void
    {
        $partEntry->user_id = Auth::id();
    }
}
