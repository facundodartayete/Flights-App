<?php

use App\Http\Controllers\AirlineController;
use Illuminate\Support\Facades\Route;


Route::get('/index', [AirlineController::class, 'index']);
Route::post('/', [AirlineController::class, 'store']);
Route::delete('/{airline}', [AirlineController::class, 'delete']);
Route::put('/{airline}', [AirlineController::class, 'update']);
Route::put('/{airline}/cities', [AirlineController::class, 'updateCities']);
Route::get('/', [AirlineController::class, 'getAirlines']);
Route::get('/{airline}/cities', [AirlineController::class, 'getAirlineCities']);
