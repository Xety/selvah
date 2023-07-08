<?php

namespace Selvah\Models\Presenters;

trait PartPresenter
{
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
