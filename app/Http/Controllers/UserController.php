<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class,'user'); //aplica a todos los metodos resource
        //su respectivo $this->authorize('metodd', parametro);
    }

    public function index()
    {
        return Inertia::render('Clinic/Users/Index',[
            'users' => User::with('role')->filter(request(['search']))->paginate(6)->withQueryString(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Clinic/Users/CreateEditUser',[
            'roles' => Role::all()
        ]);
    }

   
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','email','max:255',Rule::unique('users','email')],
            'password' => ['required','max:255'],
            'role_id' => 'required|numeric|exists:roles,id',
        ]);

        User::create($attributes);

        return to_route('users.index')->with([
            'type' => 'success',
            'message' => 'El Usuario se Ha Creado Satisfactoriamente'
        ]);
    }

    
    public function show(User $user)
    {
        //$this->authorize('view',$user);
        return Inertia::render('Clinic/Users/Show',[
            'user' => $user->load('role')
        ]);
    }

    
    public function edit(User $user)
    {
        return Inertia::render('Clinic/Users/CreateEditUser',[
            'user' => $user,
            'roles' => Role::all()
        ]);
    }

    
    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => 'required|max:255',
            'email' => ['required','email','max:255',Rule::unique('users','email')->ignore($user->id)],
            'password' => ['required','max:255',Rule::excludeIf($user != null)],
            'role_id' => 'required|numeric|exists:roles,id',
        ]);

        $user->update($attributes);

        return to_route('users.show',$user->id)->with([
            'type' => 'success',
            'message' => 'El Usuario se Ha Editado Satisfactoriamente'
        ]);
    }

    
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with([
            'type' => 'success',
            'message' => 'El Usuario se Ha Eliminado Satisfactoriamente'
        ]);
    }

    public function forceDelete(int $id)
    {
        $usuario = User::withTrashed()->find($id);

        if(request()->user()->cannot('forceDelete',$usuario)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }
        
        $usuario->forceDelete();

        return redirect()->route('users.index')->with([
            'type' => 'success',
            'message' => 'Usuario Eliminado por Completo del Sistema Satisfactoriamente!.',
        ]);
    }
    public function deletedIndex(int $id) //sin el id no lo detecta en el web.php
    {
        if(request()->user()->cannot('deleteIndex',User::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        return Inertia::render('Clinic/Users/DeletedIndex',[
            'users' => User::onlyTrashed()->with(['role'])->get()
        ]);
    }

    public function restore(int $id)
    {
        if(request()->user()->cannot('restore',User::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        User::withTrashed()->find($id)->restore();
        
        return redirect()->route('users.index')->with([
			'type' => 'success',
            'message' => 'Usuario Restaurado Satisfactoriamente!.',
		]);
    }

    public function restoreAll()
    {
        if(request()->user()->cannot('restoreAll',User::class)){ //asi porque es en $int lo arriuna
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); // es igual $this->authorize()
        }

        User::onlyTrashed()->restore();

        return redirect()->route('users.index')->with([
			'type' => 'success',
            'message' => 'Usuarios Restaurados Satisfactoriamente!.',
		]);
    }

    public function resetPassword(User $user){

        $this->authorize('resetPassword', $user);

        return Inertia::render('Clinic/Users/ResetPassword',[
            'user' => $user->makeHidden(['name','email','password','created_at','updated_at','role','role_id'])
        ]);
    }
    public function updateResetPassword(Request $request,User $user){
        
       $this->authorize('updateResetPassword', $user); //llamando a la policy

        $attr = $request->validate([
            'password' => ['required','max:255'],
        ]);

        $user->update($attr);

        return to_route('users.show',$user->id)->with([
            'type' => 'success',
            'message' => 'Se a reseteado la Contraseña Satisfactoriamente.'
        ]);
    }
}
