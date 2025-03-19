<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserController;

Route::get('/projects', [ProjectsController::class, 'index']);
Route::get('/tasks/{projectId}', [TasksController::class, 'index']);
Route::get('/tasks/{projectId}/{taskId}', [TasksController::class, 'show']);
Route::get('/projects/{id}', [ProjectsController::class, 'show']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::middleware(['auth:api', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);

    Route::post('/projects', [ProjectsController::class, 'store']);
    Route::put('/projects/{id}', [ProjectsController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectsController::class, 'destroy']);

    Route::post('/tasks/{projectId}', [TasksController::class, 'store']);
    Route::put('/tasks/{projectId}/{taskId}', [TasksController::class, 'update']);
    Route::delete('/tasks/{projectId}/{taskId}', [TasksController::class, 'destroy']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
});
