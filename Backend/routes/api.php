<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\AppoinmentController;
use App\Http\Controllers\API\MedicineController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\PemeriksaanController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::get('listdoctor', [DoctorController::class, 'index']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('doctor', DoctorController::class);
    Route::resource('appoinment', AppoinmentController::class);
    Route::post('updatedoctor/{id}', [DoctorController::class, 'update']);

    Route::resource('medicine', MedicineController::class);
    Route::resource('patient', PatientController::class);
    Route::resource('room', RoomController::class);
});

Route::resource('pemeriksaan', PemeriksaanController::class);