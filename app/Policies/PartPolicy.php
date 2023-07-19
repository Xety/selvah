<?php

namespace Selvah\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Selvah\Models\Part;
use Selvah\Models\User;

class PartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('viewAny part');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Part $part): bool
    {
        return $user->can('view part');
    }

    /**
     * Determine whether the user can export models.
     */
    public function export(User $user): bool
    {
        return $user->can('export part');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create part');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Part $part): bool
    {
        // Give update access to all parts, remove to only allow created part,
        // false to not allow any update.
        if ($user->can('update part')) {
            return true;
        }

        //return $user->id === $part->user_id;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->can('delete part');
    }
}
