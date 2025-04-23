<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserAuthController;
use App\Models\Categorie;
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

Route::get('/categories', function () {
    return view('/admin/categories');
})->name('categories');




Route::get('/register', [UserAuthController::class, 'registerPage']);
Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::post('/register' , [UserAuthController::class , 'register'])->name('register');

Route::get('/login', [UserAuthController::class, 'loginPage']);
Route::post('/login', [UserAuthController::class, 'login'])->name('login');

Route::get('/home' , [ActivityController::class , 'index'])->name('activities.index');
Route::get('/activityCreate' , [ActivityController::class , 'create'])->name('activities.create');
Route::post('/activity/create' , [ActivityController::class , 'store'])->name('activities.store');

Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');



Route::post('/centerCreate' , [CentreController::class , 'store'])->name('centers.store');
Route::get('/centers' , [CentreController::class , 'index']);
Route::post('/center/create' , [CentreController::class , 'create']);
Route::post('/center/update' , [CentreController::class , 'update']);
Route::post('/center/delete' , [CentreController::class , 'delete']);

Route::get('/types' , [TypeController::class , 'index']);
Route::post('/type/create' , [TypeController::class , 'create']);
Route::post('/type/store' , [TypeController::class , 'store']);
Route::post('/type/update' , [TypeController::class , 'update']);
Route::post('/type/delete' , [TypeController::class , 'delete']);




// Route::get('/categories' , [CategorieController::class , 'index'])->name('categoris');
Route::post('/categorie/create' , [CategorieController::class , 'create'])->name('categories.create');
Route::post('/categorie/store' , [CategorieController::class , 'store'])->name('categories.store');
Route::post('/categorie/edit' , [CategorieController::class , 'edit'])->name('categories.edit');
Route::post('/categorie/update' , [CategorieController::class , 'update'])->name('categories.update');
Route::post('/categorie/delete' , [CategorieController::class , 'delete']);