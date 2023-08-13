<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the materials for the zone.
     *
     * @return HasMany
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class)->withTrashed();
    }
}
