<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\PartExit;

class PartExitObserver
{
    /**
     * Handle the PartExit "creating" event.
     */
    public function creating(PartExit $partExit): void
    {
        $partExit->user_id = Auth::id();
    }
}
