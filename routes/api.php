<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerAppointmentController;


Route::prefix('app')->group(function () {
    Route::post('/a', [CustomerAppointmentController::class, 'appointment']);
    Route::put('/{eventId}', [CustomerAppointmentController::class, 'cangeAppointmnt']);
    Route::delete('/{eventId}', [CustomerAppointmentController::class, 'deleteAppointmnt']);    
  
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
