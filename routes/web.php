<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index']);
Route::get('/opt1', [\App\Http\Controllers\WelcomeController::class, 'opt1']);
Route::get('/opt2', [\App\Http\Controllers\WelcomeController::class, 'opt2']);
Route::get('/opt3', [\App\Http\Controllers\WelcomeController::class, 'opt3']);
Route::get('/opt4', [\App\Http\Controllers\WelcomeController::class, 'opt4']);
