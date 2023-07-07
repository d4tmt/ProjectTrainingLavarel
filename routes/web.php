<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;


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

//Route::get('/user', function () {
//    return view('welcome');
//});

Route::get('/animal', [AnimalController::class, 'index']);
Route::get('/animal/{id}', [AnimalController::class, 'show']);
Route::post('/animal', [AnimalController::class, 'create']);
Route::put('/animal', [AnimalController::class, 'update']);
Route::delete('/animal/{id}', [AnimalController::class, 'delete']);

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'create']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'delete']);


