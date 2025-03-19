<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Filament\Pages\Login;

Route::get('/login', Login::class)->name('filament.admin.auth.login');


/*Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'showAdminPanel'])->name('admin.dashboard');*/
