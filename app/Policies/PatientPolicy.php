<?php

namespace App\Policies;

use App\Models\clinic\Patient;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientPolicy
{
    use HandlesAuthorization;

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
    public function view(User $user, Patient $patient): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function create(User $user): bool
    {
        //dd('hola');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Patient $patient): bool
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Patient $patient)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }

    public function forceDelete(User $user)
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;
    }
    
    public function deleteIndex(User $user)
    {
       return true;
    }

    public function restore(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }
    public function restoreAll(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }
}
