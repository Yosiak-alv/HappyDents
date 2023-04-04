<?php

namespace App\Http\Controllers\Clinic;

use App\Models\clinic\Treatment;
use App\Models\clinic\Patient;
use App\Models\clinic\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PatientVisitController extends Controller
{
    public function __construct(){
        //$this->authorizeResource(Visit::class);
    }
    public function create(int $id){
        if(request()->user()->cannot('createvisit',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        return Inertia::render('Clinic/Patients/Patient_Visits/CreateEditPatientVisit', [
            'treatments' => Treatment::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);

    }
    public function store(Request $request, int $id){
        if(request()->user()->cannot('createvisit',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }
        
        $attributes = $request->validate([
            'patient_id' => 'required|numeric',
            'treatment_id' => 'required|numeric',
            'payment' => 'required|numeric|gt:0|decimal:2|max:255',
            'date' => 'required'
        ]);

        Visit::create($attributes);

        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Visita Creado Satisfactoriamente!.',
		]);



    }
    public function edit(Visit $visit){
        $this->authorize('update',$visit);

        return Inertia::render('Clinic/Patients/Patient_Visits/CreateEditPatientVisit', [
            'treatments' => Treatment::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($visit->patient_id),
            'patient_visit' => $visit
        ]);
    }
    public function update(Request $request,Visit $visit){
        $this->authorize('update',$visit);

        $attributes = $request->validate([
            'patient_id' => 'required|numeric',
            'treatment_id' => 'required|numeric',
            'payment' => 'required|numeric|gt:0|decimal:2|max:255',
            'date' => 'required'
        ]);

        $visit->update($attributes);

        return redirect()->route('pacientes.show',$visit->patient_id)->with([
			'type' => 'success',
            'message' => 'Visita Editada Satisfactoriamente!.',
		]);

    }
    public function destroy(){
       //ya veremos  
    }
}
