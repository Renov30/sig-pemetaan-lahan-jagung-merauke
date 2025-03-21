<?php

namespace App\Policies;

use App\Models\Distrik;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DistrikPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Distrik $distrik): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Distrik $distrik): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Distrik $distrik): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Distrik $distrik): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Distrik $distrik): bool
    {
        if ($user->can('view distrik'))
            return true;
        else
            return false;
    }
}
