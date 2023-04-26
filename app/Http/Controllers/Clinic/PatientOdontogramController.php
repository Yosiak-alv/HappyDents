<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\OdontogramRequest;
use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PatientOdontogramController extends Controller
{
    public function create(int $id){
        if(request()->user()->cannot('createOdontogram',[Detention::class,$id])){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }
        return Inertia::render('Clinic/Patients/Patient_Odontogram/CreateEditPatientOdontogram',[
            'detentions'=> Detention::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }
    public function store(OdontogramRequest $request, int $id){
        if(request()->user()->cannot('createOdontogram',[Detention::class,$id])){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }

        $paciente =  Patient::find($id);
        
        //dd($request->only('condition'));
        //dd($attributes['detention_id']);
       /*  $dententions = collect($request->only('condition'))
        ->map(function($dentention){
            return [$dentention];
        }); */

        //dd($dententions);
        //dd($request->validated());
        $paciente->detentions()->attach($request->validatedDetentionsId());

        return redirect()->route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Odontograma Creado Satisfactoriamente!.',
            'level' => 'success'
		]);
    }
    public function edit(int $id){
        if(request()->user()->cannot('updateOdontogram',Detention::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }

        $paciente = Patient::select(['id','name'])->get()->find($id);
        
        //dd($paciente->detentions()->select(['id','condition'])->get());
        
        return Inertia::render('Clinic/Patients/Patient_Odontogram/CreateEditPatientOdontogram',[
            'detentions'=> Detention::all(['id','name']),
            'patient' => $paciente,
            //'patient_odontogram_detentions' => $paciente->detentions()->select('id')->get()->pluck('id'),
            'selected_patient_odontogram_detentions' => $paciente->detentions()->select('id')->get()->pluck('id'),
            //'selected_patient_odontogram_detentions' => $paciente->detentions()->select('id','condition')->get(),
            'selected_odontogram_conditions' => $paciente->detentions()->select(['condition'])->get()->pluck('condition'),
            'odontogram_conditions' => $paciente->detentions()->select(['id','condition'])->get()
        ]);
    }
    public function update(OdontogramRequest $request , int $id){

        if(request()->user()->cannot('updateOdontogram',Detention::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }

        $paciente = Patient::find($id);


        $paciente->detentions()->sync($request->validatedDetentionsId());
        
        return to_route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Odontograma Editado Satisfactoriamente!.',
            'level' => 'success'
		]);
    }
    public function remove(int $id){

        if(request()->user()->cannot('removeOdontogram',Detention::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }
        $paciente = Patient::find($id);
        $paciente->detentions()->sync([]); //agrega solo lo del array lo demas hace detach
        
        return redirect()->route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Odontograma Eliminado Satisfactoriamente!.',
            'level' => 'success'
		]);
        
    }
}
