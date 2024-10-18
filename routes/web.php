<?php

use App\Controllers\Auth\AuthController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\Auth\RegistrationController;
use App\Controllers\Auth\SuccessRegistrationController;
use App\Controllers\HomeController;
use App\Controllers\Task\TaskController;
use App\Controllers\User\UserController;
use App\Routes\Route;

Route::get('/', HomeController::class);
Route::get('/login', LoginController::class);
Route::post('/auth', AuthController::class);
Route::post('/logout', LogoutController::class);
Route::get('/registration', RegistrationController::class);
Route::post('/register', RegisterController::class);
Route::get('/success_registration', SuccessRegistrationController::class);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/read', [UserController::class, 'read']);

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/add', [TaskController::class, 'add']);
Route::post('/tasks/create', [TaskController::class, 'create']);
Route::get('/tasks/read', [TaskController::class, 'read']);
Route::get('/tasks/edit', [TaskController::class, 'edit']);
Route::post('/tasks/update', [TaskController::class, 'update']);
Route::post('/tasks/delete', [TaskController::class, 'delete']);
Route::post('/tasks/complete', [TaskController::class, 'complete']);
