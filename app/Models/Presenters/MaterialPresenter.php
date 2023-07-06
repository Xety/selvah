<?php

namespace Selvah\Models\Presenters;

trait MaterialPresenter
{
/**
     * Get the material url.
     *
     * @return string
     */
    public function getMaterialUrlAttribute(): string
    {
        if (!isset($this->slug) || $this->getKey() == null) {
            return '';
        }

        return route('material.show', ['slug' => $this->slug, 'id' => $this->getKey()]);
    }
}
