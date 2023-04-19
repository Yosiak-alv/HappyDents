<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\FamilyBackgroundCreateEditRequest;
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

    public function store(FamilyBackgroundCreateEditRequest $request){
        
        if(request()->user()->cannot('create',FamilyBackground::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }
        
        $result = FamilyBackground::create($request->validated());

        return redirect()->route('pacientes.show',$result->patient_id)->with([
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
    public function update(FamilyBackgroundCreateEditRequest $request,FamilyBackground $familyBackground){
        $this->authorize('update',$familyBackground);

        $familyBackground->update($request->validated());

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
