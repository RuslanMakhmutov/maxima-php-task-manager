<?php

use app\Controllers\Auth\AuthController;
use app\Controllers\Auth\LoginController;
use app\Controllers\Auth\LogoutController;
use app\Controllers\Auth\RegisterController;
use app\Controllers\Auth\RegistrationController;
use app\Controllers\Auth\SuccessRegistrationController;
use app\Controllers\HomeController;
use app\Controllers\Task\TaskController;
use app\Routes\Route;

Route::get('/', HomeController::class);
Route::get('/login', LoginController::class);
Route::post('/auth', AuthController::class);
Route::post('/logout', LogoutController::class);
Route::get('/registration', RegistrationController::class);
Route::post('/register', RegisterController::class);
Route::get('/success_registration', SuccessRegistrationController::class);

// Route::get('/users', 'UserController@index');

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/add', [TaskController::class, 'add']);
Route::post('/tasks/create', [TaskController::class, 'create']);
Route::get('/tasks/read', [TaskController::class, 'read']);
Route::get('/tasks/edit', [TaskController::class, 'edit']);
Route::post('/tasks/update', [TaskController::class, 'update']);
Route::post('/tasks/delete', [TaskController::class, 'delete']);
Route::post('/tasks/complete', [TaskController::class, 'complete']);
