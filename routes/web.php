<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleCalendarController;  



Route::get('/', function () {
    return view('welcome');
});
