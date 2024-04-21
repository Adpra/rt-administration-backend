<?php

namespace App\Policies;

use App\Models\Billing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BillingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->is_admin) {
            return true;
        }
        
        return $user->house()->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Billing $billing): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Billing $billing): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Billing $billing): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Billing $billing): bool
    {
        return false;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Billing $billing): bool
    {
        return false;

    }
}
