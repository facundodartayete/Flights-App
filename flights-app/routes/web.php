<?php

use App\Http\Controllers\AirlineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('cities', [CityController::class, 'index']);
Route::get('cities/table', [CityController::class, 'updatedTable']);
Route::post('cities', [CityController::class, 'store']);
Route::delete('cities/{city}', [CityController::class, 'delete']);
Route::put('cities/{city}', [CityController::class, 'update']);

Route::get('airlines', [AirlineController::class, 'index']);
Route::get('/api/airlines', [AirlineController::class, 'getAirlines']);
Route::post('airlines', [AirlineController::class, 'store']);
Route::delete('airlines/{airline}', [AirlineController::class, 'delete']);
Route::put('airlines/{airline}', [AirlineController::class, 'update']);
Route::put('airlines/{airline}/cities', [AirlineController::class, 'updateCities']);
