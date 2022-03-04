<?php

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

Route::get('/index', [CityController::class, 'index']);
Route::get('/table', [CityController::class, 'updatedTable']);
Route::post('/', [CityController::class, 'store']);
Route::delete('/{city}', [CityController::class, 'delete']);
Route::put('/{city}', [CityController::class, 'update']);


