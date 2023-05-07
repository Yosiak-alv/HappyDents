<?php

namespace App\Policies;

use App\Models\clinic\Diagnostic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DiagnosticPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Diagnostic $diagnostic)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     
     */
    public function createDiagnostic(User $user)
    {
        //dd('hoola');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     
     */
    public function update(User $user, Diagnostic $diagnostic)
    {
        //dd('hoola');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
    */
    public function delete(User $user, Diagnostic $diagnostic)
    {
        //dd('hoola');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     */
    public function restore(User $user, Diagnostic $diagnostic)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     */
    public function forceDelete(User $user, Diagnostic $diagnostic)
    {
        return true;
        
    }
}
