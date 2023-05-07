<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if(request()->user()->role->type == 'administrador'){
            $files = Storage::disk('local')->allFiles('HappyDents');
            $names = array_map(function($file){
                return basename($file); // remove the folder name
            }, $files);
            
            return Inertia::render('Backup/Index',[
                'files' => $names
            ]);
        }
        abort(403,'THIS ACTION IS UNAUTHORIZED. '); 

        
    }

    public function download(string $name)
    {
        try {
            if(request()->user()->role->type == 'administrador'){
                return response()->download(storage_path('app/HappyDents/'.$name));
            }
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
        } catch (Exception $e) {
            
            return back()->with([
                'type' => 'floating',
                'message' => $e->getMessage(),
                'level' => 'danger'
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            if(request()->user()->role->type == 'administrador'){
                $command = 'backup:run'; 
                $params = [ '--only-db' => true,
                            '--disable-notifications' => true ]; 
                \Artisan::call($command, $params);  

                return back()->with([
                    'type' => 'floating',
                    'message' => 'El Respaldo se Realizo Correctamente.',
                    'level' => 'success'
                ]);
            }
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
           
        }catch(Exception $e){
            return back()->with([
                'type' => 'floating',
                'message' => $e->getMessage(),
                'level' => 'danger'
            ]);
        }
        
       
    }

    public function destroy(string $name)
    {
        try {
            if(request()->user()->role->type == 'administrador'){
                unlink(storage_path('app/HappyDents/'.$name));

                return back()->with([
                    'type' => 'floating',
                    'message' => 'El Respaldo se Elimino Correctamente.',
                    'level' => 'success'
                ]);
            }
            abort(403,'THIS ACTION IS UNAUTHORIZED. ');

        } catch (Exception $e) {
            return back()->with([
                'type' => 'floating',
                'message' => $e->getMessage(),
                'level' => 'danger'
            ]);
        }
    }
}
