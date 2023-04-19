<?php

namespace App\Http\Controllers\clinic;

use App\Http\Requests\TreatmentCreateEditRequest;
use App\Models\clinic\Treatment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
class TreatmentController extends Controller
{
    public function __construct(){
        //$this->authorizeResource(Treatment::class,'tratamiento');
    }

    /**
     * Display a listing of the resource
     */
    public function index()
    {       
        return Inertia::render('Clinic/Treatments/Index',[
            'treatments' => Treatment::all()
        ]);
    }

    /**
     */
    public function create()
    {
        return Inertia::render('Clinic/Treatments/CreateEditTreatment');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(TreatmentCreateEditRequest $request)
    {
        
        $attributes = $request->validated();

        $attributes['price'] = number_format((float) $attributes['price'] , 2, '.', '');

        Treatment::create($attributes);

        return redirect()->route('tratamientos.index')->with([
            'type' => 'success',
            'message' => 'El Tratamiento se Ha Creado Satisfactoriamente!.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $tratamiento)
    {
        
        return Inertia::render('Clinic/Treatments/CreateEditTreatment',[
            'treatment' => $tratamiento
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(TreatmentCreateEditRequest $request, Treatment $tratamiento)
    {
       
        $attributes = $request->validated();

        $attributes['price'] = number_format((float) $attributes['price'] , 2, '.', '');

        $tratamiento->update($attributes);

        return redirect()->route('tratamientos.index')->with([
            'type' => 'success',
            'message' => 'El Tratamiento se Ha Editado Satisfactoriamente!.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Treatment $tratamiento)
    {
       
        $tratamiento->delete();

        return redirect()->route('tratamientos.index')->with([
            'type' => 'success',
            'message' => 'El Tratamiento se Ha Eliminado Satisfactoriamente!.'
        ]);
    }
    public function forceDelete(int $id)
    {
        if(request()->user()->cannot('forceDelete',Treatment::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $tratamiento = Treatment::withTrashed()->find($id);
        $tratamiento->forceDelete();

        return redirect()->route('tratamientos.index')->with([
            'type' => 'success',
            'message' => 'Tratamiento Eliminado por Completo del Sistema Satisfactoriamente!.',
        ]);
    }
    public function deletedIndex()
    {
        if(request()->user()->cannot('deleteIndex',Treatment::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        return Inertia::render('Clinic/Treatments/DeletedIndex',[
            'treatments' => Treatment::onlyTrashed()->get()
        ]);
    } 

    public function restore(int $id)
    {
        if(request()->user()->cannot('restore',Treatment::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        Treatment::withTrashed()->find($id)->restore();
        
        return redirect()->route('tratamientos.index')->with([
			'type' => 'success',
            'message' => 'Tratamiento Restaurado Satisfactoriamente!.',
		]);
    }

    public function restoreAll()
    {
        if(request()->user()->cannot('restoreAll',Treatment::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        Treatment::onlyTrashed()->restore();

        return redirect()->route('tratamientos.index')->with([
			'type' => 'success',
            'message' => 'Tratamientos Restaurados Satisfactoriamente!.',
		]);
    }
}
