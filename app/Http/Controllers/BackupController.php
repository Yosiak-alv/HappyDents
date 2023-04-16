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
            //dd($e->getMessage());
            return back()->with([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        //dd($name);

        //Storage::download();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            if(request()->user()->role->type == 'administrador'){
                /*  $command = 'backup:run'; 
                $params = [ '--only-db' => true,
                            '--disable-notifications' => true ]; 
                \Artisan::call($command, $params);  */
                /* \Artisan::command('backup:run --only-db --disable-notifications',function(){

                })->purpose('crear un respaldo de la base de datos.'); */
                //Artisan::call('backup:run --only-db --disable-notifications');
                /* Artisan::call('backup:run',[
                    '--only-db' => true,
                    '--disable-notifications' => true
                ]); */
                //dd(\Artisan::output());
                return back()->with([
                    'type' => 'success',
                    'message' => 'El Respaldo se Realizo Correctamente.'
                ]);
            }
            abort(403,'THIS ACTION IS UNAUTHORIZED. '); 
           
        }catch(Exception $e){
            return back()->with([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        
       
    }

    public function destroy(string $name)
    {
        try {
            if(request()->user()->role->type == 'administrador'){
                unlink(storage_path('app/HappyDents/'.$name));

                return back()->with([
                    'type' => 'success',
                    'message' => 'El Respaldo se Elimino Correctamente.'
                ]);
            }
            abort(403,'THIS ACTION IS UNAUTHORIZED. ');

        } catch (Exception $e) {
            return back()->with([
                'type' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
