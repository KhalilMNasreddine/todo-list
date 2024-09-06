<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('login');
});
Route::post('/login', [UserController::class, "login"]);
Route::post('/register', [UserController::class, "register"]);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/register', function () {
    return view('register');
});
//Route::get('/todo', function () {
//    return view('todo');
//});
Route::post('/todo/{id}/edit', 'TodoController@editTask');
Route::post('/create-task', [TodoController::class, 'createTask']);
Route::get('/todo', [TodoController::class, 'showAllTasks'])->name('showAllTasks');
Route::patch('/edit-task/{id}', [TodoController::class, 'editTask'])->name('editTask');
Route::delete('/delete-task/{id}', [TodoController::class, 'deleteTask'])->name('deleteTask');