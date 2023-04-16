<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\PatientCreateUpdateRequest;
use App\Models\clinic\BranchOffice;
use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{

    public function __construct(){
        $this->authorizeResource(Patient::class,'paciente');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Inertia::render('Clinic/Patients/Index',[
            'patients' => Patient::select(['id','dui','name','lastname','phone'])->latest('created_at')->filter(request(['search']))->paginate(10)->withQueryString(),
            'filters' => \Illuminate\Support\Facades\Request::only('search'),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Clinic/Patients/CreateEditPatient', [
            'branch_offices' => BranchOffice::select(['id','name'])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(PatientCreateUpdateRequest $request, $paciente = null)
    {
        //dd($request->validated());
        Patient::create($request->validated());

        return redirect()->route('pacientes.index')->with([
			'type' => 'success',
            'message' => 'Paciente Creado Satisfactoriamente!.',
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Patient $paciente)
    {
        //$this->authorize('view',$paciente);
        return Inertia::render('Clinic/Patients/Show',[
            //'patient' => Patient::with(['hospitalizations','detentions','diagnostics','systems','family_backgrounds.system','visits.treatment'])->find($paciente->id),
            'patient' => $paciente->load(['hospitalizations','detentions','diagnostics','systems','family_backgrounds.system','visits.treatment']),
            'branch_offices' => BranchOffice::select(['id','name'])->get(),
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(PatientCreateUpdateRequest $request, Patient $paciente) //es paciente porque la ruta recibe pacientes/{paciente}
    {
        $paciente->update($request->validated());

        //return Redirect::route('patients.show',$patient->id);
        return back()->with([
			'type' => 'success',
            'message' => 'Paciente Actualizado Satisfactoriamente!.',
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Patient $paciente)
    {
        $paciente->delete();
        
        return redirect()->route('pacientes.index')->with([
			'type' => 'success',
            'message' => 'Paciente Eliminado Satisfactoriamente!.',
		]);
    }

    public function forceDelete(int $id)
    {
        if(request()->user()->cannot('forceDelete',Patient::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        $paciente = Patient::withTrashed()->find($id);
        $paciente->forceDelete();

        return redirect()->route('pacientes.index')->with([
			'type' => 'success',
            'message' => 'Paciente Eliminado por Completo del Sistema Satisfactoriamente!.',
		]);
    }
    public function deleteIndex()
    {
        if(request()->user()->cannot('deleteIndex',Patient::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        return Inertia::render('Clinic/Patients/DeletedIndex',[
            'patients' => Patient::onlyTrashed()->select(['id','dui','name','lastname','phone','deleted_at'])->get()
        ]);
    }

    public function restore(int $id)
    {
        if(request()->user()->cannot('restore',Patient::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        Patient::withTrashed()->find($id)->restore();

        return redirect()->route('pacientes.index')->with([
			'type' => 'success',
            'message' => 'Paciente Restaurado Satisfactoriamente!.',
		]);
    }
    public function restoreAll()
    {
        if(request()->user()->cannot('restoreAll',Patient::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        Patient::onlyTrashed()->restore();

        return redirect()->route('pacientes.index')->with([
			'type' => 'success',
            'message' => 'Pacientes Restaurados Satisfactoriamente!.',
		]);
    }
}
