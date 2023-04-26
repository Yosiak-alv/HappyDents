<?php

namespace App\Http\Controllers\clinic;

use App\Http\Requests\VisitCreateUpdateRequest;
use App\Models\clinic\Patient;
use App\Models\clinic\Treatment;
use App\Models\clinic\Visit;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if(request()->user()->cannot('viewAny',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        //dd(Visit::with(['patient:id,name','treatment'])->latest('date')->get());
        return Inertia::render('Clinic/Visits/Index',[
            'visits' => Visit::with(['patient:id,name','treatment'])->latest('date')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        if(request()->user()->cannot('createVisit',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        return Inertia::render('Clinic/Visits/CreateEditVisit',[
            'patients' => Patient::all(['id','name']),
            'treatments' => Treatment::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(VisitCreateUpdateRequest $request)
    {
        if(request()->user()->cannot('createVisit',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        $attr = $request->validated();
        
        $price = Treatment::where('id',$attr['treatment_id'])->first(['price'])->price;
        $result = array_merge($attr,['payment' => number_format((float)(($price*0.05) + $price), 2, '.', '')]);

        Visit::create($result);

        return redirect()->route('visitas.index')->with([
            'type' => 'floating',
            'message' => 'Visita Creada Satisfactoriamente!.',
            'level' => 'success'
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
     *
     */
    public function edit(Visit $visita)
    {
        //dd($visita);
        if(request()->user()->cannot('update',$visita)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        return Inertia::render('Clinic/Visits/CreateEditVisit',[
            'patients' => Patient::all(['id','name']),
            'treatments' => Treatment::all(),
            'visit' => $visita
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(VisitCreateUpdateRequest $request, Visit $visita)
    {
        if(request()->user()->cannot('update',$visita)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        $attr = $request->validated();

        $price = Treatment::where('id',$attr['treatment_id'])->first(['price'])->price;
        $result = array_merge($attr,['payment' => number_format((float)(($price*0.05) + $price), 2, '.', '')]);

        $visita->update($result);

        return to_route('visitas.index')->with([
            'type' => 'floating',
            'message' => 'Visita Editada Satisfactoriamente!.',
            'level' => 'success'
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Visit $visita)
    {
        if(request()->user()->cannot('delete',$visita)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
       $visita->delete();

       return back()->with([
            'type' => 'floating',
            'message' => 'Visita Eliminada Satisfactoriamente!.',
            'level' => 'success'
       ]);
    }

    public function forceDelete(int $id)
    {
        if(request()->user()->cannot('forceDelete',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $visita = Visit::withTrashed()->find($id);
        $visita->forceDelete();

        return redirect()->route('visitas.index')->with([
            'type' => 'floating',
            'message' => 'Visita Eliminada por Completo del Sistema Satisfactoriamente!.',
            'level' => 'success'
        ]);
    }

    public function deletedIndex()
    {
        if(request()->user()->cannot('deleteIndex',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        return Inertia::render('Clinic/Visits/DeletedIndex',[
            'visits' => Visit::onlyTrashed()->with(['patient:id,name','treatment'])->get()
        ]);
    }

    public function restore(int $id)
    {
        if(request()->user()->cannot('restore',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        Visit::withTrashed()->find($id)->restore();
        
        return redirect()->route('visitas.index')->with([
            'type' => 'floating',
            'message' => 'Visita Restaurada Satisfactoriamente!.',
            'level' => 'success'
		]);
    }
    public function restoreAll()
    {
        if(request()->user()->cannot('restoreAll',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        Visit::onlyTrashed()->restore();

        return redirect()->route('visitas.index')->with([
            'type' => 'floating',
            'message' => 'Visitas Restauradas Satisfactoriamente!.',
            'level' => 'success'
		]);
    }

    public function generateInvoicePDF(Visit $visita)
    {
        if(request()->user()->cannot('generateInvoicePDF',Visit::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $visita = $visita->load(['treatment','patient.branch_office']);
        //dd($visita);
        $pdf = Pdf::loadView('invoice_pdf',['visita' => $visita]);

        return $pdf->download('invoice.pdf');
    }
}
