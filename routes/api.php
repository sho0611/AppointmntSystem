<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\PropertyController;   
use App\Http\Controllers\ViewPropertyController;

Route::prefix('appointment')->group(function () {
    Route::post('/post', [AppointmentController::class, 'appointment']);
    Route::put('/{eventId}', [AppointmentController::class, 'changeAppointment']);
    Route::delete('/{eventId}', [AppointmentController::class, 'deleteAppointment']);    
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


Route::get('/index', function () {
    return view('index');
});

Route::get('/form/{propertyId}', function ($propertyId) {
    return view('appointment/form', ['propertyId' => $propertyId]);
});

Route::get('/detail', function () {
    return view('appointment/detail');  
});

//不動産内容の編集画面
Route::get('/property/list', function () {
    return view('property/list');
}); 

Route::get('/property/{propertyId}', function ($propertyId) {
    return view('property/edit', ['propertyId' => $propertyId]);
});

//不動産内容投稿
Route::get('/property', function () {
    return view('property/post');
});


Route::prefix('admin')->group(function () {
    Route::post('/create', [AdminController::class, 'adminCreate']);
}); 


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
