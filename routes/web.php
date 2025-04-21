<?php

use App\Http\Controllers\UserAuthController;
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

Route::get('/register', [UserAuthController::class, 'registerPage']);
Route::post('/register' , [UserAuthController::class , 'register'])->name('register');

Route::get('/login', [UserAuthController::class, 'loginPage']);
Route::post('/login', [UserAuthController::class, 'login'])->name('login');





