<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Lot;

class LotObserver
{
    /**
     * Handle the Lot "creating" event.
     */
    public function creating(Lot $lot): void
    {
        $lot->user_id = Auth::id();
    }
}
