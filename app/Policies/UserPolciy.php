<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolciy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user) :bool
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model) :bool
    {
        if($user->role->type == 'administrador'){
            return $user->id != $model->id;
        }
        return false;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) :bool
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model):bool
    {
        if($user->role->type == 'administrador'){
            return $user->id != $model->id;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model):bool
    {
        if($user->role->type == 'administrador'){
            return $user->id != $model->id;
        }
        return false;
    }
    public function deleteIndex(User $user)
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user) :bool
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;

    }
    public function restoreAll(User $user)
    {
        if($user->role->type == 'administrador'){
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user,User $model):bool
    {
        if($user->role->type == 'administrador'){
            return $user->id != $model->id;
        }
        return false;

    }
    public function resetPassword(User $user, User $model): bool
    {
        if($user->role->type == 'administrador'){
            return $user->id != $model->id;
        }
        return false;
    }

    public function updateResetPassword(User $user, User $model):bool
    {
        if($user->role->type == 'administrador')
        {
            return $user->id != $model->id;
        }
        return false;
    }
}
