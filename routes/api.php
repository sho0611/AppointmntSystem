<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController;   


Route::prefix('app')->group(function () {
    Route::post('/a', [AppointmentController::class, 'appointment']);
    Route::put('/{eventId}', [AppointmentController::class, 'changeAppointment']);
    Route::delete('/{eventId}', [AppointmentController::class, 'deleteAppointment']);    
});

Route::prefix('admin')->group(function () {
    Route::post('/create', [AdminController::class, 'adminCreate']);
}); 


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
