<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::apiResource('tasks', TaskController::class);
Route::get('/users/{id}/tasks', [TaskController::class, 'getUserTasks']);
