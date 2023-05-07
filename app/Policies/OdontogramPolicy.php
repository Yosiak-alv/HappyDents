<?php

namespace App\Policies;

use App\Models\clinic\Patient;
use App\Models\User;
use App\Models\clinic\Detention;
use Illuminate\Auth\Access\HandlesAuthorization;

class OdontogramPolicy
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

    public function createOdontogram(User $user,int $id)
    {
        $paciente = Patient::find($id);
        //dd(!$paciente->detentions()->exists());
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'asistente dental' ){
            return !$paciente->detentions()->exists();
        }
        return false;
    }

    public function updateOdontogram(User $user){
        //dd('aaaa');
        if($user->role->type == 'administrador' || $user->role->type == 'doctor' || $user->role->type == 'asistente dental' ){
            return true;
        }
        return false;
    }

    public function removeOdontogram(User $user){
        //dd($user);
        
        if($user->role->type == 'administrador' || $user->role->type == 'doctor'){
            return true;
        }
        return false;
    }
}
