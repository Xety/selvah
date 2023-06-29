<?php

namespace Selvah\Models;

use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Get all the maintenances for the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class)->withTimestamps();
    }
}
