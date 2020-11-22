<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ItemsController;
use \App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'viewLogin']);
Route::get('/register', [AuthController::class, 'viewRegister']);
Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/login', [AuthController::class, 'auth'])->name('login');
//Route::post('/auth/logout', [AuthController::class, 'getItems']);
Route::get('/items', [ItemsController::class, 'getItems']);
Route::post('/items', [ItemsController::class, 'postItem']);
Route::get('/items/{itemId}', [ItemsController::class, 'getItem']);
Route::delete('/items/{itemId}', [ItemsController::class, 'deleteItem']);
