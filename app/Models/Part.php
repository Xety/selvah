<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Selvah\Models\Presenters\PartPresenter;

class Part extends Model
{
    use Countable;
    use PartPresenter;
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'show_url',
        'stock_total'
    ];

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
     * Get the material that owns the part.
     *
     * @return BelongsTo
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class)->withTrashed();
    }

    /**
     * Get the user that owns the part.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the partEntries for the part.
     *
     * @return HasMany
     */
    public function partEntries(): HasMany
    {
        return $this->hasMany(PartEntry::class);
    }

    /**
     * Get the partsExits for the part.
     *
     * @return HasMany
     */
    public function partExits(): HasMany
    {
        return $this->hasMany(PartExit::class);
    }

    /**
     * Get the user that edited the part.
     *
     * @return HasOne
     */
    public function editedUser(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'edited_user_id')->withTrashed();
    }
}
