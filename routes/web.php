<?php

use app\Controllers\Auth\LoginController;
use app\Controllers\Auth\RegistrationController;
use app\Controllers\HomeController;
use app\Controllers\Task\TaskController;
use app\Routes\Route;

// Route::get('/', function() {
//     echo 'Hello World!';
// });
// Route::get('/', [HomeController::class, 'index']);

Route::get('/', HomeController::class);
Route::get('/login', LoginController::class);
Route::get('/registration', RegistrationController::class);

Route::get('/users', 'UserController@index');

Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/tasks/read', [TaskController::class, 'read']);
