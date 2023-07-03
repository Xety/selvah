<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

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
        'incident_at',
        'impact',
        'solved',
        'solved_at',
        'impact',
        'edit_count',
        'is_edited',
        'edited_user_id',
        'edited_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'incident_at' => 'datetime',
        'solved_at' => 'datetime',
        'edited_at' => 'datetime',
        'solved' => 'boolean',
        'is_edited' => 'boolean'
    ];

    /**
     * Get the material that owns the incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the user that owns the incident.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
