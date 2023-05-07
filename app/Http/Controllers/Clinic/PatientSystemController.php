<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\PatientSystemCreateEditRequest;
use App\Models\clinic\Patient;
use App\Models\clinic\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;


class PatientSystemController extends Controller
{
    public function create(int $id){

        if(request()->user()->cannot('createSystemPatient',[System::class,$id])){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        return Inertia::render('Clinic/Patients/Patient_Systems/CreateEditPatientSystem',[
            'systems'=> System::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }

    public function store(PatientSystemCreateEditRequest $request, int $id){
        if(request()->user()->cannot('createSystemPatient',[System::class,$id])){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $paciente =  Patient::find($id);

        $paciente->systems()->attach($request->validatedSystemId());

        return redirect()->route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Sistema Inmunologico Creado Satisfactoriamente!.',
            'level' => 'success'
		]);
    }

    public function edit(int $id){
        if(request()->user()->cannot('updateSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $paciente = Patient::select(['id','name'])->get()->find($id);
        //dd($paciente->systems()->select(['id','condition'])->get()->pluck(['id','condition']));
        return Inertia::render('Clinic/Patients/Patient_Systems/CreateEditPatientSystem',[
            'systems'=> System::all(['id','name']),
            'patient' => $paciente,
            'patient_systems' => $paciente->systems()->select('id')->get()->pluck('id'),
            'patient_systems_conditions' => $paciente->systems()->select(['system_id','condition'])->get()->pluck('condition','system_id')
        ]);
    }

    public function update(PatientSystemCreateEditRequest $request, int $id){
        if(request()->user()->cannot('updateSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        $paciente = Patient::find($id);

        $conditions = collect([]);
        
        foreach ($request->conditions() as $index => $condition) {
            if ($request->validatedSystemId()->contains($index)) {
                $conditions->put($index, [ 'condition' => $condition ]);
            }
        }
        $paciente->systems()->sync($conditions);

        return to_route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Sistema Inmunologico Editado Satisfactoriamente!.',
            'level' => 'success'
		]);
    }

    public function remove(int $id){

        if(request()->user()->cannot('removeSystemPatient',System::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        $paciente = Patient::find($id);
        $paciente->systems()->sync([]); //agrega solo lo del array lo demas hace detach

        return to_route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Sistema Inmunologico Eliminado Satisfactoriamente!.',
            'level' => 'success'
		]);
        
    }
}
