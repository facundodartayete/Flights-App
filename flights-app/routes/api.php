<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\FlightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/airlines', [AirlineController::class, 'getAirlines']);
Route::get('/airlines/{airline}/cities', [AirlineController::class, 'getAirlineCities']);


Route::delete('/flights/{flight}', [FlightController::class, 'delete']);
Route::get('/flights', [FlightController::class, 'getFlights']);
Route::post('/flights', [FlightController::class, 'store']);
Route::put('/flights/{flight}', [FlightController::class, 'update']);
