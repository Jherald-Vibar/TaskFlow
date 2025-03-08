<?php

use App\Http\Controllers\Auth\AuthController;
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
    return view('welcome');
})->name('homepage');

//Auth
Route::get('register', [AuthController::class, 'register'])->name('registrationForm');
Route::post('register', [AuthController::class,'store'])->name('store');
Route::get('auth/google', [AuthController::class, 'redirect'])->name('google-auth');
Route::get('/auth/google/callback', [AuthController::class,'googleAuth'])->name('googleAuthenticated');
Route::get('login', [AuthController::class, 'login'])->name('loginForm');
