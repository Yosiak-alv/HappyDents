<?php

namespace App\Policies;

use App\Models\clinic\Treatment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TreatmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' ){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Treatment $treatment)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function create(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' ){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Treatment $treatment)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' ){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Treatment $treatment)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' ){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
   
     */
    public function restore(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    public function restoreAll(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can permanently delete the model.
     *
     */
    public function forceDelete(User $user)
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;
    }

    public function deleteIndex(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }
}
