<?php

use App\Http\Controllers\Api\PropertiesController;
use App\Http\Controllers\Api\ReservationController;
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


Route::apiResource('/properties', PropertiesController::class);
Route::apiResource('/reservation', ReservationController::class);
/* Route::apiResource('properties/{id}', PropertiesController::class, 'destroy');
 */
// Route::delete('/properties/{id}', [PropertiesController::class, 'destroyProperties'])->name('destroyProperties');

/* Route::delete('/properties/{id}', [PropertiesController::class, 'destroyProperties']);
 */