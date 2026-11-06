<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');

Route::get('/reservation', [ReservationsController::class, 'index'])->middleware('auth')->name('reservationMain');
Route::post('/reservation',[ReservationsController::class, 'store'])->name('reservationStore');

Route::get('/register',[AuthorizationController::class,'showRegister'])->name('registerForm');

Route::post('/register',[AuthorizationController::class,'register'])->name('register');

Route::get('/login',[AuthorizationController::class,'showLogin'])->name('loginForm');

Route::post('/login',[AuthorizationController::class,'login'])->name('login');

Route::post('/logout',[AuthorizationController::class,'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('activities', ActivityController::class);
    Route::resource('areas', AreaController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('chefs', ChefController::class);
    Route::resource('dishes', FoodController::class);
    Route::resource('tables', TableController::class);

});
