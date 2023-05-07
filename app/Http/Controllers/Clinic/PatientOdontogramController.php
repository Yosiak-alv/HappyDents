<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\OdontogramRequest;
use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PatientOdontogramController extends Controller
{
    public function create(int $id){
        if(request()->user()->cannot('createOdontogram',[Detention::class,$id])){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }
        return Inertia::render('Clinic/Patients/Patient_Odontogram/CreateEditPatientOdontogram',[
            'detentions'=> Detention::all(['id','name']),
            'patient' => Patient::select(['id','name'])->get()->find($id)
        ]);
    }
    public function store(OdontogramRequest $request, int $id){
        if(request()->user()->cannot('createOdontogram',[Detention::class,$id])){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }

        $paciente =  Patient::find($id);
        
        $conditions = collect([]);
        
        foreach ($request->conditions() as $index => $condition) {
            if ($request->validatedDetentionsId()->contains($index)) {
                $conditions->put($index, [ 'condition' => $condition ]);
            }
        }
 
        $paciente->detentions()->sync($conditions);

        return redirect()->route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Odontograma Creado Satisfactoriamente!.',
            'level' => 'success'
		]);
    }
    public function edit(int $id){
        if(request()->user()->cannot('updateOdontogram',Detention::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }

        $paciente = Patient::select(['id','name'])->get()->find($id);
        
        return Inertia::render('Clinic/Patients/Patient_Odontogram/CreateEditPatientOdontogram',[
            'detentions'=> Detention::all(['id','name']),
            'patient' => $paciente,
            'selected_patient_odontogram_detentions' => $paciente->detentions()->select('id')->get()->pluck('id'),
            'selected_odontogram_conditions' => $paciente->detentions()->select(['detention_id' ,'condition'])->get()->pluck('condition', 'detention_id'),
        ]);
    }
    public function update(OdontogramRequest $request , int $id){

        if(request()->user()->cannot('updateOdontogram',Detention::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }
        
        $paciente = Patient::find($id);
        
        $conditions = collect([]);
        
        foreach ($request->conditions() as $index => $condition) {
            if ($request->validatedDetentionsId()->contains($index)) {
                $conditions->put($index, [ 'condition' => $condition ]);
            }
        }
        $paciente->detentions()->sync($conditions);
        
        return to_route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Odontograma Editado Satisfactoriamente!.',
            'level' => 'success'
		]);
    }
    public function remove(int $id){

        if(request()->user()->cannot('removeOdontogram',Detention::class)){
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        }
        $paciente = Patient::find($id);
        $paciente->detentions()->sync([]); //agrega solo lo del array lo demas hace detach
        
        return redirect()->route('pacientes.show',$id)->with([
            'type' => 'floating',
            'message' => 'Odontograma Eliminado Satisfactoriamente!.',
            'level' => 'success'
		]);
        
    }
}
