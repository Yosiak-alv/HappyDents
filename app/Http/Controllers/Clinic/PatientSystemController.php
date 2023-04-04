<?php

namespace App\Http\Controllers\Clinic;

use App\Models\clinic\Patient;
use App\Models\clinic\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;


class PatientSystemController extends Controller
{
    public function create(int $id){

        if(request()->user()->cannot('createSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        return Inertia::render('Clinic/Patients/Patient_Systems/CreateEditPatientSystem',[
            'systems'=> System::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }

    public function store(Request $request, int $id){
        if(request()->user()->cannot('createSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $paciente =  Patient::find($id);
        $attributes = $request->validate([
            'system_id' => 'required|array',
            'system_id.*' =>'numeric|gt:0|decimal:0|max:255', //representa la iteracion de cada una 
        ]);

        $paciente->systems()->attach($attributes['system_id']);

        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Sistema Inmunologico Creado Satisfactoriamente!.',
		]);
    }

    public function edit(int $id){
        if(request()->user()->cannot('updateSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $paciente = Patient::select(['id','name'])->get()->find($id);
        return Inertia::render('Clinic/Patients/Patient_Systems/CreateEditPatientSystem',[
            'systems'=> System::all(['id','name']),
            'patient' => $paciente,
            'patient_systems' => $paciente->systems()->select('id')->get()->pluck('id')
        ]);
    }

    public function update(Request $request, int $id){
        if(request()->user()->cannot('updateSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        $paciente = Patient::find($id);
        $attributes = $request->validate([
            'system_id' => 'required|array',
            'system_id.*' =>'numeric|gt:0|decimal:0|max:255', //representa la iteracion de cada una 
        ]);

        $paciente->systems()->sync($attributes['system_id']);

        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Sistema Inmunologico Editado Satisfactoriamente!.',
		]);
    }

    public function remove(int $id){

        if(request()->user()->cannot('removeSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        $paciente = Patient::find($id);
        $paciente->systems()->sync([]); //agrega solo lo del array lo demas hace detach

        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Sistema Inmunologico Eliminado Satisfactoriamente!.',
		]);
        
    }
}
