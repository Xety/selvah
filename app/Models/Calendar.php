<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Calendar extends Model
{
    use HasFactory;

    /**
     * All type with their labels. (Used for radio buttons)
     */
    public const EVENTS_TYPES = [
        'chargement_coque' => [
            'title' => 'Chargement Coque',
            'color' => '#f87272'
        ],
        'chargement_pvt' => [
            'title' => 'Chargement PVT',
            'color' => '#33aec1'
        ],
        'chargement_huile' => [
            'title' => 'Chargement Huile',
            'color' => '#f8d20d'
        ],
        'extrusion' => [
            'title' => 'Extrusion',
            'color' => '#7839ff'
        ],
        'trituration' => [
            'title' => 'Trituration',
            'color' => '#3abff8'
        ],
        'intervention' => [
            'title' => 'Intervention',
            'color' => '#48f15e'
        ],
        'qualite' => [
            'title' => 'Qualité',
            'color' => '#f000b8'
        ],
        'reunion' => [
            'title' => 'Réunion',
            'color' => '#ddf148'
        ],
    ];

    /**
     * Indicates if the model should be timestamped
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'title',
        'started',
        'ended',
        'color',
        'allDay'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started' => 'datetime',
        'ended' => 'datetime',
        'allDay' => 'boolean'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Set the user id to the new lot before saving it.
        static::creating(function ($model) {
            $model->user_id = Auth::id();
        });
    }

    /**
     * Get the user that created the Calendar.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
