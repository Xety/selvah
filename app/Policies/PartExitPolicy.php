<?php

namespace Selvah\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Selvah\Models\PartExit;
use Selvah\Models\User;

class PartExitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny partExit');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PartExit $partExit): bool
    {
        return $user->can('view partExit');
    }

    /**
     * Determine whether the user can export models.
     */
    public function export(User $user): bool
    {
        return $user->can('export partExit');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create partExit');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        // Give update access to all partExits, remove to only allow created partExit,
        // false to not allow any update.
        return $user->can('update partExit');

        //return $user->id === $partExit->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('delete partExit');
    }
}
