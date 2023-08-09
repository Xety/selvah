<?php

namespace Selvah\Models;

use Eloquence\Behaviours\CountCache\Countable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Incident extends Model
{
    use Countable;
    use HasFactory;
    use SoftDeletes;

    /**
     * All impact with their labels.
     */
    public const IMPACT = [
        'mineur' => 'Mineur',
        'moyen' => 'Moyen',
        'critique' => 'Critique'
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
        'started_at',
        'impact',
        'is_finished',
        'finished_at',
        'impact',
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
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'is_finished' => 'boolean',
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
     * Get the material that owns the incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class)->withTrashed();
    }

    /**
     * Get the user that owns the incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    /**
     * Get the user that edited the incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function editedUser()
    {
        return $this->hasOne(User::class, 'id', 'edited_user_id')->withTrashed();
    }
}
