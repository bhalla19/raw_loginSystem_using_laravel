<?php

use App\Http\Controllers\authController;
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

Route::get('/',[authController::class,'homepage'])->name('homepage');
Route::get('login', [authController::class, 'login'])->name('login');
Route::get('register', [authController::class, 'register'])->name('register');
Route::post('register', [authController::class, 'registerDetails'])->name('registerDetails');
Route::get('dashboard', [authController::class, 'dashboard']);
Route::post('postlogin', [authController::class, 'loginDetails'])->name('loginDetails');
Route::get('signout', [authController::class, 'signOut'])->name('signout');