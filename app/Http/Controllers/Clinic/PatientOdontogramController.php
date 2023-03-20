<?php

namespace App\Http\Controllers\Clinic;

use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PatientOdontogramController extends Controller
{
    public function create(int $id){
        return Inertia::render('Clinic/Patients/Patient_Odontogram/CreateEditPatientOdontogram',[
            'detentions'=> Detention::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }
    public function store(Request $request, int $id){
        $paciente =  Patient::find($id);
        $attributes = $request->validate([
            'detention_id' => 'required|array',
            'detention_id.*' =>'numeric|gt:0|decimal:0|max:255', //representa la iteracion de cada una 
        ]);

        $paciente->detentions()->attach($attributes['detention_id']);

        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Odontograma Creado Satisfactoriamente!.',
		]);
    }
    public function edit(int $id){
        $paciente = Patient::select(['id','name'])->get()->find($id);
        return Inertia::render('Clinic/Patients/Patient_Odontogram/CreateEditPatientOdontogram',[
            'detentions'=> Detention::all(['id','name']),
            'patient' => $paciente,
            'patient_odontogram_detentions' => $paciente->detentions()->select('id')->get()->pluck('id')
        ]);
    }
    public function update(Request $request , int $id){
        $paciente = Patient::find($id);

        $attributes = $request->validate([
            'detention_id' => 'required|array',
            'detention_id.*' =>'numeric|gt:0|decimal:0|max:255', 
        ]);

        $paciente->detentions()->sync($attributes['detention_id']);
        
        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Odontograma Editado Satisfactoriamente!.',
		]);
    }
    public function remove(int $id){
        $paciente = Patient::find($id);
        $paciente->detentions()->sync([]); //agrega solo lo del array lo demas hace detach
        
        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Odontograma Eliminado Satisfactoriamente!.',
		]);
        
    }
}