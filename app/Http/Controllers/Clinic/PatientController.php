<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Requests\Patient\PatientCreateUpdateRequest;
use App\Models\clinic\BranchOffice;
use App\Models\clinic\Detention;
use App\Models\clinic\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
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
    public function show($id)
    {
        return Inertia::render('Clinic/Patients/Show',[
            'patient' => Patient::with(['hospitalizations','detentions','diagnostics','systems','family_backgrounds.system','visits.treatment'])->find($id),
            'branch_offices' => BranchOffice::select(['id','name'])->get(),
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        
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
    public function destroy($id)
    {
        //
    }
}
