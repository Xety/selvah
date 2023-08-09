<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Part;

class PartObserver
{
    /**
     * Handle the Part "creating" event.
     */
    public function creating(Part $part): void
    {
        $part->user_id = Auth::id();
    }

    /**
     * Handle the Part "updating" event.
     */
    public function updating(Part $part): void
    {
        $part->is_edited = true;
        $part->edit_count++;
        $part->edited_user_id = Auth::id();
    }
}
