<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\FileAttenteController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SalleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::resources([
    'patients' => PatientController::class,
    'salles' => SalleController::class,
    'rendez-vous' => RendezVousController::class,
    'consultations' => ConsultationController::class,
    'file-attente' => FileAttenteController::class,
]);
