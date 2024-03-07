<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveBalanceController;
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
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::prefix('')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('register', [AuthController::class, 'registerForm'])->name('admin.auth.register-form');
        Route::get('/get-states/{country}', [AuthController::class, 'getStates'])->name('get-states');
        Route::get('/get-city/{state}', [AuthController::class, 'getCity'])->name('get-city');
        Route::post('register', [AuthController::class, 'register'])->name('admin.auth.register');
        Route::get('login', [AuthController::class, 'loginForm'])->name('admin.auth.login-form');
        Route::post('login', [AuthController::class, 'login'])->name('admin.auth.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('home', [DashboardController::class, 'home'])->name('admin.home');

        Route::resource('leave-record', EmployeeController::class);
        Route::get('getDatatableLeaveRecord', [EmployeeController::class, 'getDatatableLeaveRecord'])->name('getDatatableLeaveRecord');

        Route::resource('leave-balance', LeaveBalanceController::class);
        Route::get('getDatatableLeaveBalance', [LeaveBalanceController::class, 'getDatatableLeaveBalance'])->name('getDatatableLeaveBalance');
    });




});
