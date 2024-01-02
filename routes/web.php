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

Route::get('/', function () {
    return view('index');
})->name('/');

Route::post('/add', [\App\Http\Controllers\UserController::class, 'input'])->name('add');
Route::get('/result', [\App\Http\Controllers\UserController::class, 'result'])->name('result');
