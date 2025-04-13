<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\User\UserController;
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
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotpassForm');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordPost'])->name('resetPass');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');

//User
Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    //Home-Today
    Route::get('task/', [UserController::class, 'taskPage'])->name('user-task');

    //Dashboard
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    //Task Management
    Route::post('task', [TaskController::class, 'taskStore'])->name('task.store');
    Route::put('task/{id}', [TaskController::class, 'updateTask'])->name('updateTask');
    Route::put('tasks/{id}', [TaskController::class, 'updateProgress'])->name('updateProgress');
    Route::delete('task/{id}', [TaskController::class, 'deleteTask'])->name('deleteTask');
    Route::get('search-task', [TaskController::class, 'searchTask'])->name('searchTask');
    Route::get('filter-task', [TaskController::class, 'filterTask'])->name('filterTask');
    Route::get('/upcoming-task', [TaskController::class, 'upcomingTaskPage'])->name('upcomingTask');
    Route::get('/today-task', [TaskController::class, 'todayPage'])->name('today');

    //Account Management
    Route::get('create-account/{id}', [UserController::class, 'createForm'])->name('createForm');
    Route::post('create-account/{id}', [UserController::class, 'storeAccount'])->name('storeAccount');
    Route::get('account/settings', [UserController::class, 'viewAccount'])->name('accountSettings');
    Route::put('account/settings/update/{id}', [UserController::class, 'updateAccount'])->name('updateAccount');
    Route::put('account/settings/update-pass/{id}', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::post('account/settings/add-pass/{id}', [UserController::class, 'addPassword'])->name('addPassword');
    Route::delete('user/{id}', [UserController::class, 'deleteAccount'])->name('deleteAccount');
    Route::get('task/category', [TaskController::class, 'categoryView'])->name('categoryView');
    Route::post('task/category', [TaskController::class, 'categoryStore'])->name('categoryStore');

    //Notification Mark As Read
    Route::patch('/notifications/mark-all-read', [TaskController::class, 'markAsRead']);
    Route::patch('/notification/{id}/mark-read', [TaskController::class, 'markSingleRead'])->name('markSingleRead');
});





