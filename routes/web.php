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
    Route::get('home', function(){
        return Inertia::render('Home', [
            'user' => 'David Guilarte'
        ]);
    });
});

Route::get('/login', function(){
    return Inertia::render('Login', [
        'user' => 'David Guilarte'
    ]);
});

Route::inertia('visits/create', 'CreateVisit');
