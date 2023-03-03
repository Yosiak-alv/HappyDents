<?php

use Illuminate\Support\Facades\Route;
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

<<<<<<< Updated upstream
Route::get('/', function () {
    return view('welcome');
=======
Route::get('admin/home', function () {
    return Inertia::render('home');
});

Route::get('admin/registro', function () {
    return view('registro');
});
Route::get('admin/antecedente', function () {
    return view('antecedente');
});
Route::get('admin/hosp', function () {
    return view('hosp');
});
Route::get('admin/diagn', function () {
    return view('diagn');
});
Route::get('admin/odontograma', function () {
    return view('odontograma');
>>>>>>> Stashed changes
});
