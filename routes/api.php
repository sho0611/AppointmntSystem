<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\PropertyController;   
use App\Http\Controllers\ViewPropertyController;

Route::prefix('app')->group(function () {
    Route::post('/a', [AppointmentController::class, 'appointment']);
    Route::put('/{eventId}', [AppointmentController::class, 'changeAppointment']);
    Route::delete('/{eventId}', [AppointmentController::class, 'deleteAppointment']);    
});

Route::prefix('p')->controller(PropertyController::class)
->group(function () {
    Route::post('/post','postProperty');
}); 

Route::prefix('property')->controller(PropertyController::class)
->group(function () {
    Route::post('/post','postProperty');
    Route::put('/{property}', 'updateProperty');
    Route::delete('/{property}', 'deleteProperty');   
});

Route::prefix('viewproperty')->controller(ViewPropertyController::class)
->group(function () {
    Route::get('/get','viewProperty');
    Route::get('/{propertyId}','viewPropertyById');
});

Route::get('/home', function () {
    return view('homePage');
});

Route::get('/appointmentForm/{propertyId}', function ($propertyId) {
    return view('appointmentForm', ['propertyId' => $propertyId]);
});

Route::get('/property', function () {
    return view('propaty');
});

Route::get('/upDateProperty', function () {
    return view('propaty');
});


Route::prefix('admin')->group(function () {
    Route::post('/create', [AdminController::class, 'adminCreate']);
}); 


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
