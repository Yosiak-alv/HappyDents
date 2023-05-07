<?php

use App\Http\Controllers\clinic\TreatmentController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\Clinic\PatientController;
use App\Http\Controllers\Clinic\PatientDiagnosticController;
use App\Http\Controllers\Clinic\PatientFamilyBackgroundController;
use App\Http\Controllers\Clinic\PatientHospitalizationController;
use App\Http\Controllers\Clinic\PatientOdontogramController;
use App\Http\Controllers\Clinic\PatientSystemController;
use App\Http\Controllers\Clinic\PatientVisitController;
use App\Http\Controllers\clinic\VisitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\clinic\Patient;
use App\Models\clinic\Treatment;
use App\Models\clinic\Visit;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->group(function(){
    Route::get('/home', function () {
        //dd(Patient::all('id')->count());
        return Inertia::render('Homepage',[
            'patients' => Patient::all('id')->count(),
            'treatments' => Treatment::all('id')->count(),
            'visits' => Visit::all('id')->count(),
            'users' => User::all('id')->count()
        ]);
    })->name('home');
    //--------pacientes
    (Route::resource('/pacientes',PatientController::class)->except(['edit']));
    Route::get('pacientes/eliminados/{paciente}',[PatientController::class,'deleteIndex'])->name('pacientes.deleteIndex');
    Route::post('pacientes/eliminados/restaurar/{paciente_id}',[PatientController::class,'restore'])->name('pacientes.restore'); //si funciona y el de pacientes no ?
    Route::post('pacientes/eliminados/restaurar/',[PatientController::class,'restoreAll'])->name('pacientes.restoreAll'); //si funciona y el de pacientes no ?
    Route::delete('pacientes/eliminados/restaurar/{paciente_id}',[PatientController::class,'forceDelete'])->name('pacientes.forceDelete'); //si funciona y el de pacientes no ?
   
    //-----------------
    //----paciente Diagnostico
    Route::get('/paciente/diagnostico/{patient_id}',[PatientDiagnosticController::class,'create'])->name('pacienteDiagnostico.create');
    Route::post('/paciente/diagnostico/{patient_id}',[PatientDiagnosticController::class,'store'])->name('pacienteDiagnostico.store');
    Route::get('/paciente/diagnostico/{diagnostic}/edit',[PatientDiagnosticController::class , 'edit'])->name('pacienteDiagnostico.edit');
    Route::patch('/paciente/diagnostico/{diagnostic}/edit',[PatientDiagnosticController::class , 'update'])->name('pacienteDiagnostico.update');
    Route::delete('/paciente/diagnostico/{diagnostic}',[PatientDiagnosticController::class , 'destroy'])->name('pacienteDiagnostico.destroy');
    //-----------------
    //-------paciente Hospitalizaciones
    Route::get('/paciente/hospitalizacion/{patient_id}',[PatientHospitalizationController::class,'create'])->name('pacienteHospitalizacion.create');
    Route::post('/paciente/hospitalizacion/{patient_id}',[PatientHospitalizationController::class,'store'])->name('pacienteHospitalizacion.store');
    Route::get('/paciente/hospitalizacion/{hospitalization}/edit',[PatientHospitalizationController::class,'edit'])->name('pacienteHospitalizacion.edit');
    Route::patch('/paciente/hospitalizacion/{hospitalization}/edit',[PatientHospitalizationController::class,'update'])->name('pacienteHospitalizacion.update');
    Route::delete('/paciente/hospitalizacion/{hospitalization}',[PatientHospitalizationController::class,'destroy'])->name('pacienteHospitalizacion.destroy');
    //---------------------------------
    //------Paciente Odontograma
    Route::get('/paciente/odontograma/{patient_id}',[PatientOdontogramController::class , 'create'])->name('pacienteOdontograma.create');
    Route::post('/paciente/odontograma/{patient_id}',[PatientOdontogramController::class , 'store'])->name('pacienteOdontograma.store');
    Route::get('/paciente/odontograma/{patient_id}/edit',[PatientOdontogramController::class , 'edit'])->name('pacienteOdontograma.edit');
    Route::patch('/paciente/odontograma/{patient_id}/edit',[PatientOdontogramController::class ,'update'])->name('pacienteOdontograma.update');
    Route::delete('/paciente/odontograma/{patient_id}/edit',[PatientOdontogramController::class ,'remove'])->name('pacienteOdontograma.remove');
    //--------------------------------
    //-----------Paciente Antecedentes Familiares
    Route::get('/paciente/antecedentes-familiares/{patient_id}',[PatientFamilyBackgroundController::class , 'create'])->name('pacienteAntecedentesFamiliares.create');
    Route::post('/paciente/antecedentes-familiares/{patient_id}',[PatientFamilyBackgroundController::class , 'store'])->name('pacienteAntecedentesFamiliares.store');
    Route::get('/paciente/antecedentes-familiares/{familyBackground}/edit',[PatientFamilyBackgroundController::class , 'edit'])->name('pacienteAntecedentesFamiliares.edit');
    Route::patch('/paciente/antecedentes-familiares/{familyBackground}/edit',[PatientFamilyBackgroundController::class , 'update'])->name('pacienteAntecedentesFamiliares.update');
    Route::delete('/paciente/antecedentes-familiares/{familyBackground}',[PatientFamilyBackgroundController::class,'destroy'])->name('pacienteAntecedentesFamiliares.destroy');
    //------------------------------------------
    //------------Paciente Visitas--------------
    Route::get('/paciente/visita/{patient_id}',[PatientVisitController::class , 'create'])->name('pacienteVisitas.create');
    Route::post('/paciente/visita/{patient_id}',[PatientVisitController::class , 'store'])->name('pacienteVisitas.store');
    Route::get('/paciente/visita/{visit}/edit',[PatientVisitController::class , 'edit'])->name('pacienteVisitas.edit');
    Route::patch('/paciente/visita/{visit}/edit',[PatientVisitController::class , 'update'])->name('pacienteVisitas.update');
    Route::delete('/paciente/visita/{visit}',[PatientVisitController::class,'destroy'])->name('pacienteVisitas.destroy');
    //------------------------------------------
    //------------Paciente Systems--------------
    Route::get('/paciente/sistema/{patient_id}',[PatientSystemController::class , 'create'])->name('pacienteSistema.create');
    Route::post('/paciente/sistema/{patient_id}',[PatientSystemController::class , 'store'])->name('pacienteSistema.store');
    Route::get('/paciente/sistema/{patient_id}/edit',[PatientSystemController::class , 'edit'])->name('pacienteSistema.edit');
    Route::patch('/paciente/sistema/{patient_id}/edit',[PatientSystemController::class ,'update'])->name('pacienteSistema.update');
    Route::delete('/paciente/sistema/{patient_id}/edit',[PatientSystemController::class ,'remove'])->name('pacienteSistema.remove');
    //------------------------------------------
    //--------------usuarios----------
    Route::resource('/users',UserController::class);
    (Route::get('users/password/{user}',[UserController::class,'resetPassword'])->name('users.resetPassword'));
    Route::patch('users/password/{user}',[UserController::class,'updateResetPassword'])->name('users.updatePassword');
    Route::get('users/eliminados/{id}',[UserController::class,'deletedIndex'])->name('users.deletedIndex'); 
    Route::post('users/eliminados/restaurar/{user_id}',[UserController::class,'restore'])->name('users.restore'); //si funciona y el de pacientes no ?
    Route::post('users/eliminados/restaurar/',[UserController::class,'restoreAll'])->name('users.restoreAll'); //si funciona y el de pacientes no ?forceDelete
    Route::delete('users/eliminados/restaurar/{user_id}',[UserController::class,'forceDelete'])->name('users.forceDelete');
    //-------------------------------
    //--------------backup-------------
    //Route::get('/backups',[BackupController::class,'index'])->name('backups.index');
    Route::get('/backupss',[BackupController::class,'index'])->name('backups.index'); //no reconoce backups entonces se puso backupss
    Route::get('/backups',[BackupController::class,'store'])->name('backups.store');
    Route::get('/backups/download/{name}',[BackupController::class,'download'])->name('backups.download');
    Route::delete('/backups/download/{name}',[BackupController::class,'destroy'])->name('backups.destroy');
    //---------------------------------

    //-------------tratamientos--------
    Route::resource('/tratamientos',TreatmentController::class)->except('show');
    Route::get('tratamientos/eliminados',[TreatmentController::class,'deletedIndex'])->name('tratamientos.deletedIndex'); 
    Route::post('tratamientos/eliminados/restaurar/{tratamientos_id}',[TreatmentController::class,'restore'])->name('tratamientos.restore'); //si funciona y el de pacientes no ?
    Route::post('tratamientos/eliminados/restaurar/',[TreatmentController::class,'restoreAll'])->name('tratamientos.restoreAll'); //si funciona y el de pacientes no ?forceDelete
    Route::delete('tratamientos/eliminados/restaurar/{tratamientos_id}',[TreatmentController::class,'forceDelete'])->name('tratamientos.forceDelete');
    //---------------------------------

    //-------------visitas---------------
    Route::resource('/visitas',VisitController::class)->except('show');
    Route::get('visitas/eliminados',[VisitController::class,'deletedIndex'])->name('visitas.deletedindex'); //si funciona y el de pacientes no ?
    Route::post('visitas/eliminados/restaurar/{visita_id}',[VisitController::class,'restore'])->name('visitas.restore'); //si funciona y el de pacientes no ?
    Route::post('visitas/eliminados/restaurar/',[VisitController::class,'restoreAll'])->name('visitas.restoreAll'); //si funciona y el de pacientes no ?forceDelete
    Route::delete('visitas/eliminados/restaurar/{visita_id}',[VisitController::class,'forceDelete'])->name('visitas.forceDelete');
    Route::get('visitas/generate-invoice-pdf/{visita}', [VisitController::class,'generateInvoicePDF'])->name('visitas.InvoicePDF');
    //------------------------------------
});

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
