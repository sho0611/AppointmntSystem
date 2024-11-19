<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//先ほど作成したGoogleCalendarControllerを読み込む    
use App\Http\Controllers\GoogleCalendarController;

Route::post('/create-event', [GoogleCalendarController::class, 'createEvent']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
