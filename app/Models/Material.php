<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Selvah\Models\Presenters\MaterialPresenter;

class Material extends Model
{
    use Countable;
    use HasFactory;
    use MaterialPresenter;
    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cleaning_test_ph_enabled' => 'boolean',
        'cleaning_alert' => 'boolean',
        'cleaning_alert_email' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'show_url'
    ];

    /**
     * Return the count cache configuration.
     *
     * @return array
     */
    public function countCaches(): array
    {
        return [
            Zone::class
        ];
    }

    /**
     * Get the zone that owns the material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class)->withTrashed();
    }

    /**
     * Get the user that owns the material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the incidents for the material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidents()
    {
        return $this->hasMany(Incident::class)->withTrashed();
    }

    /**
     * Get the maintenances for the material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class)->withTrashed();
    }

    /**
     * Get the parts for the material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parts()
    {
        return $this->hasMany(Part::class);
    }

    /**
     * Get the cleanings for the material.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cleanings()
    {
        return $this->hasMany(Cleaning::class);
    }
}
