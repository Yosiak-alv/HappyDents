<?php

namespace App\Policies;

use App\Models\clinic\FamilyBackground;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FamilyBackgroundPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, FamilyBackground $familyBackground)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, FamilyBackground $familyBackground)
    {
        //dd('hola enn unpdate');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, FamilyBackground $familyBackground)
    {
        //dd('hola enn unpdate delete');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     */
    public function restore(User $user, FamilyBackground $familyBackground)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     */
    public function forceDelete(User $user, FamilyBackground $familyBackground)
    {
        //
    }
}
