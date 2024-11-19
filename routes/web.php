<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;  

//プラウザではGETメソッドでアクセスするため、Route::getを使用   
Route::get('/create-event', [GoogleCalendarController::class, 'createEvent']);


Route::get('/', function () {
    return view('welcome');
});
