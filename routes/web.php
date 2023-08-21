<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDashboardController;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware'=>['is_login']], function(){
    Route::get('/register', [UserController::class, 'registerUser'])->name('register');   
    Route::post('/user-registered', [UserController::class, 'registered'])->name('registered');
    Route::get('/reference-register', [UserController::class, 'referenceRegistered']);
    Route::get('/email-verification/{token}', [UserController::class, 'emailVerification']);
    Route::get('/login', [UserController::class, 'loadLogin']);
    Route::post('/login', [UserController::class, 'loginUser'])->name('login');
});

Route::group(['middleware'=>['is_logout']], function(){
    Route::get('/dashboard', [UserController::class, 'loadDashboard']);
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'loadAdminDashboard']);
    Route::get('/admin/track-information', [AdminDashboardController::class, 'trackInformation'])->name('trackinformation');
    Route::get('/admin/delete', [AdminDashboardController::class, 'deleteUser'])->name('admindelete');
});