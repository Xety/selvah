<?php

namespace Selvah\Models\Presenters;

trait PartPresenter
{
    /**
     * Get the current stock of the part.
     *
     * @return int
     */
    public function getStockTotalAttribute(): int
    {
        return $this->part_entry_total - $this->part_exit_total;
    }

    /**
     * Get the part url.
     *
     * @return string
     */
    public function getPartUrlAttribute(): string
    {
        if (!isset($this->slug) || $this->getKey() == null) {
            return '';
        }

        return route('part.show', ['slug' => $this->slug, 'id' => $this->getKey()]);
    }
}
