<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserAuthController;
use GuzzleHttp\Psr7\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/activityCreate', function () {
    return view('activityCreate');
});


Route::get('/register', [UserAuthController::class, 'registerPage']);
Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::post('/register' , [UserAuthController::class , 'register'])->name('register');

Route::get('/login', [UserAuthController::class, 'loginPage']);
Route::post('/login', [UserAuthController::class, 'login'])->name('login');

Route::get('/activity/create' , [ActivityController::class , 'create'])->name('activity.create');
Route::post('/activity/create' , [ActivityController::class , 'store'])->name('activity.store');





