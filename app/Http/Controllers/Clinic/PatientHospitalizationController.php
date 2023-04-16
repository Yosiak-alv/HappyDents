<?php

namespace App\Http\Controllers\Clinic;

use App\Models\clinic\Hospitalization;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
class PatientHospitalizationController extends Controller
{
    public function __construct(){
       // $this->authorizeResource(Hospitalization::class);
    }
    public function create(int $id){
        
        if(request()->user()->cannot('createHospitalization',Hospitalization::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        return Inertia::render('Clinic/Patients/Patient_Hospitalizations/CreateEditPatientHospitalization',[
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }
    public function store(Request $request){
        
        if(request()->user()->cannot('createHospitalization',Hospitalization::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }
        $attributes = $request->validate([
            'patient_id' => 'required|numeric|gt:0',
            'reason' => 'required|max:5000',
            'date' => 'required',
        ]);

        Hospitalization::create($attributes);

        return redirect()->route('pacientes.show',$attributes['patient_id'])->with([
			'type' => 'success',
            'message' => 'Hospitalizacion Creada Satisfactoriamente!.',
		]);

    }
    public function edit(Hospitalization $hospitalization){
        $this->authorize('update',$hospitalization);

        return Inertia::render('Clinic/Patients/Patient_Hospitalizations/CreateEditPatientHospitalization',[
            'patient' => Patient::select(['id','name'])->get()->find($hospitalization->patient_id),
            'patient_hospitalization' => $hospitalization
        ]);
    }
    public function update(Request $request,Hospitalization $hospitalization){
        $this->authorize('update',$hospitalization);

        $attributes = $request->validate([
            'patient_id' => 'required|numeric|gt:0',
            'reason' => 'required|max:5000',
            'date' => 'required'
        ]);

        $hospitalization->update($attributes);

        return redirect()->route('pacientes.show',$hospitalization->patient_id)->with([
			'type' => 'success',
            'message' => 'Hospitalizacion Editada Satisfactoriamente!.',
		]);

    }
    public function destroy(Hospitalization $hospitalization){
        $this->authorize('delete',$hospitalization);

        $hospitalization->delete();
        return back()->with([
			'type' => 'success',
            'message' => 'Hospitalizacion Eliminado Satisfactoriamente!.',
		]);
    }
}
