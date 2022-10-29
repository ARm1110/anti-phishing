<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AntiPhishingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/check', [AntiPhishingController::class, 'check'])->name('check');
Route::get('/login', [LoginController::class, 'index'])->name('panel');
Route::post('/login', [LoginController::class, 'authenticate'])->name('panel.login');

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/add', [DashboardController::class, 'create'])->name('dashboard.add');
        Route::post('/dashboard/add', [DashboardController::class, 'store'])->name('dashboard.store');
        Route::get('/dashboard/logout', [LogoutController::class, 'perform'])->name('dashboard.logout');
    }
);
