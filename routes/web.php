<?php

use App\Http\Controllers\Clinic\PatientController;
use App\Http\Controllers\Clinic\PatientDiagnosticController;
use App\Http\Controllers\Clinic\PatientFamilyBackgroundController;
use App\Http\Controllers\Clinic\PatientHospitalizationController;
use App\Http\Controllers\Clinic\PatientOdontogramController;
use App\Http\Controllers\Clinic\PatientSystemController;
use App\Http\Controllers\Clinic\PatientVisitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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
Route::get('/home', function () {
    return Inertia::render('Homepage');
})->name('home');


//--------pacientes
Route::resource('/pacientes',PatientController::class);
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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
