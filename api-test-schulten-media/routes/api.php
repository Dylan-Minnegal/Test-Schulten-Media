<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;


Route::get('/projects', [ProjectsController::class, 'index']);
Route::post('/projects', [ProjectsController::class, 'store']);
Route::get('/projects/{id}', [ProjectsController::class, 'show']);
Route::put('/projects/{id}', [ProjectsController::class, 'update']);
Route::delete('/projects/{id}', [ProjectsController::class, 'destroy']);

Route::get('/tasks/{projectId}', [TasksController::class, 'index']);
Route::post('/tasks/{projectId}', [TasksController::class, 'store']);
Route::get('/tasks/{projectId}/{taskId}', [TasksController::class, 'show']);  
Route::put('/tasks/{projectId}/{taskId}', [TasksController::class, 'update']);  
Route::delete('/tasks/{projectId}/{taskId}', [TasksController::class, 'destroy']);  


