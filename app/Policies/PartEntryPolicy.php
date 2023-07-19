<?php

namespace Selvah\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Selvah\Models\PartEntry;
use Selvah\Models\User;

class PartEntryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny partEntry');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PartEntry $partEntry): bool
    {
        return $user->can('view partEntry');
    }

    /**
     * Determine whether the user can export models.
     */
    public function export(User $user): bool
    {
        return $user->can('export partEntry');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create partEntry');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PartEntry $partEntry): bool
    {
        // Give update access to all partEntries, remove to only allow created partEntry,
        // false to not allow any update.
        return $user->can('update partEntry');

        //return $user->id === $partEntry->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('delete partEntry');
    }
}
