<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\DiagnosticCreateUpdateRequest;
use App\Models\clinic\Diagnostic;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class PatientDiagnosticController extends Controller
{
    public function __construct(){
        //$this->authorizeResource(Diagnostic::class); //si funciona
    }
    public function create(int $id){
        //$this->authorize('createDiagnostic',[request()->user(),$id]); //no funciona
        if(request()->user()->cannot('createDiagnostic',Diagnostic::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        return Inertia::render('Clinic/Patients/Patient_Diagnostics/CreateEditPatientDiagnostic',[
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }
    public function store(DiagnosticCreateUpdateRequest $request){
        if(request()->user()->cannot('createDiagnostic',Diagnostic::class)){ //asi porque es en $int lo arriuna
            abort(403); // es igual $this->authorize()
        }

        $diagnostic = Diagnostic::create($request->validated());

        return redirect()->route('pacientes.show',$diagnostic->patient_id)->with([
			'type' => 'success',
            'message' => 'Diagnostico Creado Satisfactoriamente!.',
		]);

    }

    public function edit(Diagnostic $diagnostic){

        $this->authorize('update',$diagnostic);
        
        return Inertia::render('Clinic/Patients/Patient_Diagnostics/CreateEditPatientDiagnostic',[
            'patient' => Patient::select(['id','name'])->get()->find($diagnostic->patient_id),
            'patient_diagnostic' => $diagnostic
        ]);
    }
    public function update(DiagnosticCreateUpdateRequest $request , Diagnostic $diagnostic){

        $this->authorize('update',$diagnostic);

        $diagnostic->update($request->validated());

        return redirect()->route('pacientes.show',$diagnostic->patient_id)->with([
			'type' => 'success',
            'message' => 'Diagnostico Actualizado Satisfactoriamente!.',
		]);

    }
    public function destroy(Diagnostic $diagnostic){

        $this->authorize('delete',$diagnostic); //no funciona ?
        
        $diagnostic->delete();
        return back()->with([
			'type' => 'success',
            'message' => 'Diagnostico Eliminado Satisfactoriamente!.',
		]);
    }

}
