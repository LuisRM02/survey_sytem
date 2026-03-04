<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\VehicleController;

Route::get('/', function () {
    return view('home');
});
/*
Route::get('/clients', function () {
    return view('welcome');
});

Route::get('/clients/edit', function () {
    return view('clients.edit', ['id' => 20]);
});
*/

Route::resource('clients', ClientController::class);
Route::resource('vehicles', VehicleController::class);
