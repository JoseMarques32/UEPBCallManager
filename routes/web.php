<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use App\Livewire\Counter;
 
Route::get('/counter', Counter::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
