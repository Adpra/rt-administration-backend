<?php

namespace App\Policies;

use App\Models\HouseHolder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HouseHolderPolicy
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
    public function view(User $user, HouseHolder $houseHolder): bool
    {
        if($user->is_admin){
            return true;
        }

        return $houseHolder->house_id == $user->house->id;

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
    public function update(User $user, HouseHolder $houseHolder): bool
    {
        if($user->is_admin){
            return true;
        }

        return $houseHolder->house_id == $user->house->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, HouseHolder $houseHolder): bool
    {
        if($user->is_admin){
            return true;
        }

        return $houseHolder->house_id == $user->house->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, HouseHolder $houseHolder): bool
    {
        return false;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, HouseHolder $houseHolder): bool
    {
        return false;

    }
}
