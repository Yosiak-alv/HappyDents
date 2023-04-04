<?php

namespace App\Policies;

use App\Models\clinic\Hospitalization;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HospitalizationPolicy
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
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Hospitalization $hospitalization)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function createHospitalization(User $user)
    {
        //dd('create');

        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Hospitalization $hospitalization)
    {
        //dd('update');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Hospitalization $hospitalization)
    {
        //dd('delete');

        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }

    
}
