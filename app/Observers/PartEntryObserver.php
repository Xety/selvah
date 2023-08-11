<?php

namespace Selvah\Observers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Selvah\Models\PartEntry;

class PartEntryObserver
{
    /**
     * Handle the PartEntry "creating" event.
     *
     * @param PartEntry $partEntry The model to create.
     *
     * @return void
     */
    public function creating(PartEntry $partEntry): void
    {
        $partEntry->user_id = Auth::id();
    }

    /**
     * Handle the PartEntry "deleting" event.
     *
     * @param PartEntry $partEntry The model to delete.
     *
     * @return bool
     */
    public function deleting(PartEntry $partEntry): bool
    {
        // We need to check that the deleted partEntry won't make the stock in negative.
        if (($partEntry->part->stock_total - $partEntry->number) < 0) {
            Session::flash('delete.error', 'Vous ne pouvez pas supprimer une entrée qui mettrait le stock en négatif !');

            return false;
        }

        return true;
    }
}
