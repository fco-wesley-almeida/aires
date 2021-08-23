<?php

use App\Src\Application\Controllers\UserController;
use App\Src\Business\Services\Interfaces\IUserService;
use App\Src\Business\Services\UserService;
use Illuminate\Support\Facades\Route;

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

//$this->app->bind(IUserService::class, UserService::class);

Route::get('/user', [UserController::class, 'getUserList']);
Route::get('/user/{id}', [UserController::class, 'getUser']);
Route::post('/user', [UserController::class, 'createUser']);

