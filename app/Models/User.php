<?php

namespace Selvah\Models;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Selvah\Models\Presenters\UserPresenter;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use UserPresenter;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'avatar',
        'full_name',

        // Session Model
        'online'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login_date' => 'datetime',
    ];

    /**
    * Retrieve the model for a bound value.
    *
    * @param  mixed  $value
    * @param  string|null  $field
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function resolveRouteBinding($value, $field = null)
    {
        // If no field was given, use the primary key
        if ($field === null) {
            $field = $this->primaryKey;
        }
        // Apply where clause
        $query = $this->where($field, $value);

        // Conditionally remove the softdelete scope to allow seeing soft-deleted records
        if (Auth::check() && Auth::user()->can('delete', $this)) {
            $query->withoutGlobalScope(SoftDeletingScope::class);
        }

        // Find the first record, or abort
        return $query->firstOrFail();
    }

    /**
     * Get the incidents created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

     /**
     * Get the maintenances created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    /**
     * Get the notifications for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')
                        ->orderBy('read_at', 'asc')
                        ->orderBy('created_at', 'desc');
    }
}
