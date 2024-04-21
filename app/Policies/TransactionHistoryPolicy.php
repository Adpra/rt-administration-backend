<?php

namespace App\Policies;

use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransactionHistoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TransactionHistory $transactionHistory): bool
    {
        if ($user->is_admin) {
            return true;
        }
    
        return $transactionHistory->house_id === $user->house->id;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TransactionHistory $transactionHistory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TransactionHistory $transactionHistory): bool
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TransactionHistory $transactionHistory): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TransactionHistory $transactionHistory): bool
    {
        return false;
    }
}
