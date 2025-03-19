<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Filament\Http\Middleware\Authenticate;
use Filament\Facades\Filament;



Route::get('/', function () {
    return view('welcome');
});

Route::middleware([AdminMiddleware::class])->group(function () {
    Filament::serving(function () {
        Filament::registerNavigationItems([
            
        ]);
    });
});