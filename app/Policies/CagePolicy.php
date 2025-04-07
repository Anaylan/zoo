<?php

namespace App\Policies;

use App\Models\Cage;
use App\Models\User;

class CagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Cage $cage): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return !$user->empty();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cage $cage): bool
    {
        return !$user->empty();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cage $cage): bool
    {
        return !$user->empty();;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cage $cage): bool
    {
        return !$user->empty();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cage $cage): bool
    {
        return !$user->empty();
    }
}
