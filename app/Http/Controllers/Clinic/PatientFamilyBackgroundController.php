<?php

namespace App\Http\Controllers\Clinic;

use App\Models\clinic\FamilyBackground;
use App\Models\clinic\Hospitalization;
use App\Models\clinic\Patient;
use App\Models\clinic\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class PatientFamilyBackgroundController extends Controller
{
    public function __construct(){
        //$this->authorizeResource(FamilyBackground::class);
    }
    
    public function create(int $id){
        //$this->authorize('create',Auth::user());
        if(request()->user()->cannot('create',FamilyBackground::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        return Inertia::render('Clinic/Patients/Patient_Family_Backgrounds/CreateEditPatientFamilyBackground',[
            'systems' => System::select(['id','name'])->get(),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }

    public function store(Request $request){
        //$this->authorize('create',Auth::user());
        if(request()->user()->cannot('create',FamilyBackground::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }
        $attributes = $request->validate([
            'patient_id' => 'required|numeric|gt:0',
            'system_id' => 'required|numeric|gt:0',
            'relationship' =>'required|max:255',
            'condition' => 'required|max:5000'
        ]);

        FamilyBackground::create($attributes);

        return redirect()->route('pacientes.show',$attributes['patient_id'])->with([
			'type' => 'success',
            'message' => 'Antecedente Familiar Creado Satisfactoriamente!.',
		]);

    }

    public function edit(FamilyBackground $familyBackground){
        $this->authorize('update',$familyBackground);

        return Inertia::render('Clinic/Patients/Patient_Family_Backgrounds/CreateEditPatientFamilyBackground',[
            'systems' => System::select(['id','name'])->get(),
            'patient' => Patient::select(['id','name'])->get()->find($familyBackground->patient_id),
            'patient_family_background' => $familyBackground

        ]);
    }
    public function update(Request $request,FamilyBackground $familyBackground){
        $this->authorize('update',$familyBackground);

        $attributes = $request->validate([
            'patient_id' => 'required|numeric|gt:0',
            'system_id' => 'required|numeric|gt:0',
            'relationship' =>'required|max:255',
            'condition' => 'required|max:5000'
        ]);

        $familyBackground->update($attributes);

        return redirect()->route('pacientes.show',$familyBackground->patient_id)->with([
			'type' => 'success',
            'message' => 'Antecedente Familiar Actualizado Satisfactoriamente!.',
		]);
    }

    public function destroy(FamilyBackground $familyBackground){
        $this->authorize('delete',$familyBackground);

        $familyBackground->delete();
        return back()->with([
			'type' => 'success',
            'message' => 'Antecedente Familiar Eliminado Satisfactoriamente!.',
		]);
    }
}
