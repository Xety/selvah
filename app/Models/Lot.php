<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Selvah\Models\Presenters\LotPresenter;

class Lot extends Model
{
    use HasFactory;
    use LotPresenter;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'crushed_seeds_started_at' => 'datetime',
        'crushed_seeds_finished_at' => 'datetime',
        'extrusion_started_at' => 'datetime',
        'extrusion_finished_at' => 'datetime'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'crude_oil_yield',
        'soy_hull_yield',
        'crushed_waste',
        'non_compliant_bagged_tvp',
        'non_compliant_bagged_tvp_yield',
        'compliant_bagged_tvp_yield',
        'extrusion_waste',
        'lot_waste'
    ];

    /**
     * Get the user that created the lot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class)->withTrashed();
    }
}
