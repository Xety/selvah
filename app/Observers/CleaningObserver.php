<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Auth;
use Selvah\Models\Cleaning;
use Selvah\Models\Material;

class CleaningObserver
{
    /**
     * Handle the Cleaning "creating" event.
     */
    public function creating(Cleaning $cleaning): void
    {
        $cleaning->user_id = Auth::id();
    }

    /**
     * Handle the Cleaning "created" event.
     */
    public function created(Cleaning $cleaning): void
    {
        $material = Material::find($cleaning->material_id);
        $material->last_cleaning_at = now();
        $material->save();
    }

    /**
     * Handle the Cleaning "updating" event.
     */
    public function updating(Cleaning $cleaning): void
    {
        $cleaning->is_edited = true;
        $cleaning->edit_count++;
        $cleaning->edited_user_id = Auth::id();
    }
}
