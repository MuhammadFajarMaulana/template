<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//home
Route::get('/', [HomeController::class, 'index']);
Route::get('/Chef', [HomeController::class, 'chef']);


//dashboard
Route::get('/dashboard', [AdminController::class, 'index'])->middleware('auth');


//login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

//logout
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);

//register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Chef
Route::get('/chef', [ChefController::class, 'index'])->middleware('auth');
Route::get('/create', [ChefController::class, 'create'])->middleware('auth');
Route::post('/create', [ChefController::class, 'store']);
Route::get('/edit/{id}', [ChefController::class, 'edit']);
Route::put('/chef/{id}', [ChefController::class, 'update']);
Route::delete('/chef/{id}', [ChefController::class, 'destroy']);

// user
Route::get('/user',[RegisterController::class,'user'])->middleware('auth');
Route::delete('/user/{id}', [RegisterController::class, 'destroy']);

//menu
Route::get('/menu',[MenuController::class,'index'])->middleware('auth');







