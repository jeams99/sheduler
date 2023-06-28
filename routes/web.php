<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[App\Http\Controllers\MainController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/ajax_create_event',[App\Http\Controllers\FullCalendarController::class, 'createEvent'])->name('create');
Route::post('/ajax_remove_event',[App\Http\Controllers\FullCalendarController::class, 'deleteEvent'])->name('remove');;

