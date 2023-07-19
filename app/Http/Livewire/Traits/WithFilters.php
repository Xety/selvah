<?php

namespace Selvah\Http\Livewire\Traits;

trait WithFilters
{
    /**
     * Reset all filters to their default values.
     *
     * @return void
     */
    public function resetFilters()
    {
        $this->reset('filters');
    }

    /**
     * When a filter is updated, reset the page.
     *
     * @return void
     */
    public function updatedFilters()
    {
        $this->resetPage();
    }
}
