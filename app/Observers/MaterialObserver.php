<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Material;

class MaterialObserver
{
    /**
     * Handle the Material "creating" event.
     */
    public function creating(Material $material): void
    {
        $material->user_id = Auth::id();
    }
}
