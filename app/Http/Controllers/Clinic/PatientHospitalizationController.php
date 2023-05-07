<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\HospitalizationCreateUpdateRequest;
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
    public function store(HospitalizationCreateUpdateRequest $request){
        
        if(request()->user()->cannot('createHospitalization',Hospitalization::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }
       
        $hospitalization = Hospitalization::create($request->validated());

        return redirect()->route('pacientes.show',$hospitalization->patient_id)->with([
            'type' => 'floating',
            'message' => 'Hospitalizacion Creada Satisfactoriamente!.',
            'level' => 'success'
		]);

    }
    public function edit(Hospitalization $hospitalization){
        $this->authorize('update',$hospitalization);

        return Inertia::render('Clinic/Patients/Patient_Hospitalizations/CreateEditPatientHospitalization',[
            'patient' => Patient::select(['id','name'])->get()->find($hospitalization->patient_id),
            'patient_hospitalization' => $hospitalization
        ]);
    }
    public function update(HospitalizationCreateUpdateRequest $request,Hospitalization $hospitalization){
        $this->authorize('update',$hospitalization);

        $hospitalization->update($request->validated());

        return to_route('pacientes.show',$hospitalization->patient_id)->with([
            'type' => 'floating',
            'message' => 'Hospitalizacion Editada Satisfactoriamente!.',
            'level' => 'success'
		]);

    }
    public function destroy(Hospitalization $hospitalization){
        $this->authorize('delete',$hospitalization);

        $hospitalization->delete();
        return back()->with([
            'type' => 'floating',
            'message' => 'Hospitalizacion Eliminada Satisfactoriamente!.',
            'level' => 'success'
		]);
    }
}
