<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use Countable;
    use HasFactory;

    /**
     * Return the count cache configuration.
     *
     * @return array
     */
    public function countCaches(): array
    {
        return [
            Material::class
        ];
    }

    /**
     * Get the material that owns the maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the companies related to the maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    /**
     * Get the partsExits related to the maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function partsExits()
    {
        return $this->hasMany(PartExit::class);
    }

    /**
     * Get the user that edited the maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editedUser()
    {
        return $this->hasOne(User::class, 'id', 'edited_user_id');
    }
}
