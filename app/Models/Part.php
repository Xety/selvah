<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;


    /**
     * Get the material that owns the part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the partEntries for the part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partEntries()
    {
        return $this->hasMany(PartEntry::class);
    }

    /**
     * Get the partsExits for the part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partExits()
    {
        return $this->hasMany(PartExit::class);
    }

    /**
     * Get the user that edited the part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editedUser()
    {
        return $this->hasOne(User::class, 'id', 'edited_user_id');
    }
}
