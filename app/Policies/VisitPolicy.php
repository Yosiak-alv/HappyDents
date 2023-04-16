<?php

namespace App\Policies;

use App\Models\User;
use App\Models\clinic\Visit;
use Illuminate\Auth\Access\HandlesAuthorization;

class VisitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Visit $visit)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function createVisit(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Visit $visit)
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
    public function delete(User $user, Visit $visit)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }

    public function deleteIndex(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
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
    public function forceDelete(User $user)
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;
    }
    public function generateInvoicePDF(User $user)
    {
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'recepcionista'){
            return true;
        }
        return false;
    }
}
