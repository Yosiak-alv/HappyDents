<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createSystemPatient(User $user)
    {
        //return false;
        //dd('createodo');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'  ){
            return true;
        }
        return false;
    }

    public function updateSystemPatient(User $user){
        //dd('aaaa');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' ){
            return true;
        }
        return false;
    }

    public function removeSystemPatient(User $user){
        //dd($user);
        
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' ){
            return true;
        }
        return false;
    }
}
