<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Selvah\Models\Presenters\CompanyPresenter;

class Company extends Model
{
    use CompanyPresenter;
    use HasFactory;
    use SoftDeletes;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'show_url'
    ];

    /**
     * Get all the maintenances for the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function maintenances()
    {
        return $this->belongsToMany(Maintenance::class)->withTimestamps()->withTrashed();
    }
}
