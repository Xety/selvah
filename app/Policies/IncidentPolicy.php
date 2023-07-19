<?php

namespace Selvah\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Selvah\Models\Incident;
use Selvah\Models\User;

class IncidentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny incident');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Incident $incident): bool
    {
        return $user->can('view incident');
    }

    /**
     * Determine whether the user can export models.
     */
    public function export(User $user): bool
    {
        return $user->can('export incident');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create incident');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Incident $incident): bool
    {
        // Give update access to all incidents, remove to only allow created incident,
        // false to not allow any update.
        return $user->can('update incident');

        //return $user->id === $incident->user_id;
    }

    /**
     * Determine whether the user can delete the model(s).
     */
    public function delete(User $user): bool
    {
        return $user->can('delete incident');
    }
}
