<?php

namespace App\Http\Controllers\Clinic;

use App\Models\clinic\Diagnostic;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;


class PatientDiagnosticController extends Controller
{
    
    public function create(int $id){
        return Inertia::render('Clinic/Patients/Patient_Diagnostics/CreateEditPatientDiagnostic',[
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }
    public function store(Request $request){

        $attributes = $request->validate([
            'patient_id' => 'required',
            'diagnostic' => 'required|max:5000',
            'observation' => 'required|max:5000',
            'date' => 'required',
        ]);

        Diagnostic::create($attributes);

        return redirect()->route('pacientes.show',$attributes['patient_id'])->with([
			'type' => 'success',
            'message' => 'Diagnostico Creado Satisfactoriamente!.',
		]);

    }

    public function edit(Diagnostic $diagnostic){
        return Inertia::render('Clinic/Patients/Patient_Diagnostics/CreateEditPatientDiagnostic',[
            'patient' => Patient::select(['id','name'])->get()->find($diagnostic->patient_id),
            'patient_diagnostic' => $diagnostic
        ]);
    }
    public function update(Request $request , Diagnostic $diagnostic){
        $attributes = $request->validate([
            'patient_id' => 'required',
            'diagnostic' => 'required|max:5000',
            'observation' => 'required|max:5000',
            'date' => 'required'
        ]);
        $diagnostic->update($attributes);

        return redirect()->route('pacientes.show',$attributes['patient_id'])->with([
			'type' => 'success',
            'message' => 'Diagnostico Actualizado Satisfactoriamente!.',
		]);

    }
    public function destroy(Diagnostic $diagnostic){

        $diagnostic->delete();
        return back()->with([
			'type' => 'success',
            'message' => 'Diagnostico Eliminado Satisfactoriamente!.',
		]);
    }

}
