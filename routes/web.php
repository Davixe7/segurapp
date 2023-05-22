<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::group(['middleware'=>'auth'], function () {
    Route::inertia('home', 'Home', ['user'=>auth()->user()]);
    Route::resource('apartments', App\Http\Controllers\ApartmentController::class);
    Route::resource('residents', App\Http\Controllers\ResidentController::class);
    Route::resource('vehicles', App\Http\Controllers\VehicleController::class);
    Route::resource('visits', App\Http\Controllers\VisitController::class);
    Route::resource('porterias', App\Http\Controllers\PorteriaController::class);
    Route::resource('complaints', App\Http\Controllers\ComplaintController::class);
    Route::resource('reports', App\Http\Controllers\ReportController::class);
    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::resource('bills', App\Http\Controllers\BillController::class);

    Route::resource('residences', App\Http\Controllers\ResidenceController::class);
});

Route::inertia('/login', 'Login');
