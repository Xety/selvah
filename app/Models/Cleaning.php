<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cleaning extends Model
{
    use Countable;
    use HasFactory;

    /**
     * All types with their labels.
     */
    public const TYPES = [
        'daily' => 'Journalier',
        'weekly' => 'Hebdomadaire',
        'bimonthly' => 'Bi-mensuel',
        'monthly' => 'Mensuel',
        'quarterly' => 'Trimestrielle',
        'biannual' => 'Bi-annuel',
        'annual' => 'Annuel',
        'casual' => 'Occasionnel'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'material_id',
        'user_id',
        'description',
        'ph_test_water',
        'ph_test_water_after_cleaning',
        'type',
        'edit_count',
        'is_edited',
        'edited_user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_edited' => 'boolean'
    ];

    /**
     * Return the count cache configuration.
     *
     * @return array
     */
    public function countCaches(): array
    {
        return [
            Material::class,
            User::class
        ];
    }

    /**
     * Get the material that owns the cleaning.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class)->withTrashed();
    }

    /**
     * Get the user that owns the cleaning.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the user that edited the cleaning.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editedUser()
    {
        return $this->hasOne(User::class, 'id', 'edited_user_id')->withTrashed();
    }
}
