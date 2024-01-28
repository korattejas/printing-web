<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubAdminContoller;
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
        Route::get('login', [AuthController::class, 'loginForm'])->name('admin.auth.login-form');
        Route::post('login', [AuthController::class, 'login'])->name('admin.auth.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('home', [DashboardController::class, 'home'])->name('admin.home');

        Route::prefix('sub-admin')->group(function () {
            Route::get('', [SubAdminContoller::class, 'index'])->name('admin.sub-admin.index');
            Route::get('create', [SubAdminContoller::class, 'create'])->name('admin.sub-admin.create');
            Route::post('store', [SubAdminContoller::class, 'store'])->name('admin.sub-admin.store');
        });

        // Roles and Permissions
        Route::prefix('role')->group(function () {
            Route::get('', [RoleController::class, 'index'])->name('admin.role.index');
            Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
            Route::post('store', [RoleController::class, 'store'])->name('admin.role.store');
        });
        Route::prefix('permission')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('admin.permission.index');
            Route::get('getDatatablePermission', [PermissionController::class, 'getDataTablePermission'])->name('admin.getDataTablePermission');
            Route::get('create', [PermissionController::class, 'create'])->name('admin.permission.create');
            Route::post('store', [PermissionController::class, 'store'])->name('admin.permission.store');
        });
    });


    // Route::post('dologin', [AdminController::class,'dologin'])->name('dologin');

    // Route::middleware('auth:backend')->group(function () {
    //     Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');
    //     Route::get('', [HomeController::class, 'index'])->name('home');
    //     Route::get('logout', [AdminController::class,'logout'])->name('logout');
    //     Route::any('change_password', [AdminController::class,'ChangePassword'])->name('change_password');
    //     //Static content
    //     Route::resource('content_page', ContentPageController::class,['only' => ['index', 'show', 'edit', 'update']]);
    // });


});
