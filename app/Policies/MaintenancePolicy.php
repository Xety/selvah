<?php

namespace Selvah\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Selvah\Models\Maintenance;
use Selvah\Models\User;

class MaintenancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny maintenance');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Maintenance $maintenance): bool
    {
        return $user->can('view maintenance');
    }

    /**
     * Determine whether the user can export models.
     */
    public function export(User $user): bool
    {
        return $user->can('export maintenance');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create maintenance');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Maintenance $maintenance): bool
    {
        // Give update access to all maintenances, remove to only allow created maintenance,
        // false to not allow any update.
        if ($user->can('update maintenance')) {
            return true;
        }

        //return $user->id === $maintenance->user_id;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('delete maintenance');
    }
}
