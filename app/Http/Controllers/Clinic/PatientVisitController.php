<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\VisitCreateUpdateRequest;
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
        if(request()->user()->cannot('createVisit',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        return Inertia::render('Clinic/Patients/Patient_Visits/CreateEditPatientVisit', [
            'treatments' => Treatment::all(['id','name','price']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);

    }
    public function store(VisitCreateUpdateRequest $request, int $id){
        if(request()->user()->cannot('createVisit',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }
        
        $attributes = $request->validated();
        $price = Treatment::where('id',$attributes['treatment_id'])->first(['price'])->price;
        $result = array_merge($attributes,['payment' => number_format((float)(($price*0.05) + $price), 2, '.', '')]);
        
        Visit::create($result);

        return redirect()->route('pacientes.show',$id)->with([
			'type' => 'success',
            'message' => 'Visita Creada Satisfactoriamente!.',
		]);



    }
    public function edit(Visit $visit){
        $this->authorize('update',$visit);

        return Inertia::render('Clinic/Patients/Patient_Visits/CreateEditPatientVisit', [
            'treatments' => Treatment::all(['id','name','price']),
            'patient' => Patient::select(['id','name'])->get()->find($visit->patient_id),
            'patient_visit' => $visit
        ]);
    }
    public function update(VisitCreateUpdateRequest $request,Visit $visit){
        $this->authorize('update',$visit);

        $attributes = $request->validated();

        $price = Treatment::where('id',$attributes['treatment_id'])->first(['price'])->price;
        $result = array_merge($attributes,['payment' => number_format((float)(($price*0.05) + $price), 2, '.', '')]);
        
        $visit->update($result);

        return redirect()->route('pacientes.show',$visit->patient_id)->with([
			'type' => 'success',
            'message' => 'Visita Editada Satisfactoriamente!.',
		]);

    }
    public function destroy(Visit $visit){
        $this->authorize('delete',$visit);
        
        $visit->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Visita Eliminada Satisfactoriamente!.',
       ]);
    }
}
