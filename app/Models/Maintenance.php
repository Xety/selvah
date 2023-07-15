<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Maintenance extends Model
{
    use Countable;
    use HasFactory;

    /**
     * All types with their labels. (Used for radio buttons)
     */
    public const TYPES = [
        'curative' => 'Curative',
        'preventive' => 'Préventive'
    ];

    /**
     * All realizations with their labels. (Used for radio buttons)
     */
    public const REALIZATIONS = [
        'internal' => 'Interne',
        'external' => 'Externe'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'edited_at' => 'datetime',
        'is_edited' => 'boolean'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Set the user id to the new material before saving it.
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

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
     * Get the partExits related to the maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function partExits()
    {
        return $this->hasMany(PartExit::class);
    }

    /**
     * Get the user that owns the maintenance.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
