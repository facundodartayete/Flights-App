<?php

use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Flight Routes
|--------------------------------------------------------------------------
*/

Route::get('/index', [FlightController::class, 'index']);
Route::delete('/{flight}', [FlightController::class, 'delete']);
Route::get('/', [FlightController::class, 'getFlights']);
Route::post('/', [FlightController::class, 'store']);
Route::put('/{flight}', [FlightController::class, 'update']);
