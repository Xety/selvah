<?php

namespace Selvah\Models;

use Carbon\Carbon;
use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'part_url',
        'stock_total'
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

        // Update the edited fields before updating it.
        static::updating(function ($model) {
            $model->is_edited = true;
            $model->edit_count++;
            $model->edited_user_id = Auth::id();
            $model->edited_at = Carbon::now();
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
     * Get the material that owns the part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the user that owns the part.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
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
