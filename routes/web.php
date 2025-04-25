<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
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




Route::group(['middleware' => 'auth'], function () {

    Route::get('/activityCreate', [ActivityController::class, 'create'])->name('activities.create');
    Route::post('/activity/create', [ActivityController::class, 'store'])->name('activities.store');
    
    Route::post('/activities/{id}', [ActivityController::class, 'delete'])->name('activities.delete');
    Route::get('/activity/join/{id}', [UserController::class, 'show'])->name('activity.join');
    Route::post('/activity/join/{id}', [UserController::class, 'joinActivity']);

    Route::post('/activity/join/{id}', [UserController::class, 'joinActivity']);


    Route::get('activities', [UserController::class, 'showUserActivities'])->name('userActivities');

    Route::post('/centerCreate', [CentreController::class, 'store'])->name('centres.store');
    Route::get('/dashboard/centres', [CentreController::class, 'index'])->name('centres');
    Route::post('/center/create', [CentreController::class, 'create'])->name('centres.create');
    Route::put('/center/update', [CentreController::class, 'update'])->name('centres.update');
    Route::delete('/center/delete/{id}', [CentreController::class, 'delete'])->name('centres.delete');

    Route::get('/dashboard/types', [TypeController::class, 'index'])->name('types');
    Route::post('/type/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('/type/store', [TypeController::class, 'store'])->name('types.store');
    Route::put('/type/update/{id}', [TypeController::class, 'update'])->name('types.update');
    Route::delete('/type/delete/{id}', [TypeController::class, 'destroy'])->name('types.delete');




    Route::get('/dashboard/categories' , [CategorieController::class , 'index'])->name('categories');
    Route::post('/categorie/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categorie/store/', [CategorieController::class, 'store'])->name('categories.store');
    Route::post('/categorie/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categorie/update/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categorie/delete/{id}', [CategorieController::class, 'destroy'])->name('categories.delete');





});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', function () {
        return view('/admin/dashboard');
    })->name('dashboard');
    
    


});



Route::get('/register', [UserAuthController::class, 'registerPage'])->name('register');
Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');

Route::post('/register', [UserAuthController::class, 'register'])->name('register');

Route::get('/login', [UserAuthController::class, 'loginPage'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('login');

Route::get('/', [ActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');
Route::put('/centres/adresses/update/{id}', [CentreController::class, 'updateCentreAdresse'])->name('centres.adresses.update');


Route::get('/not-authorized', function () {
    return view('/notAuthorized');
})->name('notAuthorized');