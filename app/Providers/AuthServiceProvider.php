<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use App\Models\clinic\System;
use App\Models\clinic\Treatment;
use App\Models\User;
use App\Models\clinic\Diagnostic;
use App\Policies\DiagnosticPolicy;
use App\Policies\OdontogramPolicy;
use App\Policies\PatientPolicy;
use App\Policies\SystemPolicy;
use App\Policies\TreatmentPolicy;
use App\Policies\UserPolciy;
use App\Policies\VisitPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use League\Flysystem\UnixVisibility\VisibilityConverter;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        //'App\Models\User' => 'App\Policies\UserPolicy',
        User::class => UserPolciy::class, //si no la agrago no funciona
        Visit::class => VisitPolicy::class,
        Patient::class => PatientPolicy::class,
        //Treatment::class => TreatmentPolicy::class,
        //patients sin esto funciona ?
        //Diagnostic::class => DiagnosticPolicy::class , //no lo he probado xd funciona sin agregarlo
        //familybackground funciona si agregarlo aqui ?
        //hospitalization funciona si agregarlo aqui ?
        Detention::class => OdontogramPolicy::class, //creado sin asignarle el --model sino no funciona
        System::class => SystemPolicy::class // revisar el create con edit despues xd
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        //dd('it works');
        $this->registerPolicies(); //registra todas las politicas supuestamente

        
    }
}
