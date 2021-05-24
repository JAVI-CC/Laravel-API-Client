<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JuegoController;
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

Route::get('/', [JuegoController::class, 'index'])->name('juegos.index');

Route::prefix('auth/')->group(function () {
    //Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('userinfo', [AuthController::class, 'userinfo'])->name('userinfo');
});

Route::prefix('juegos/')->group(function () {

    Route::get('add', [JuegoController::class, 'add_form'])->name('add_form');

    Route::post('add', [JuegoController::class, 'add'])->name('add');

    Route::get('{slug}', [JuegoController::class, 'show'])->name('show');

    Route::post('edit', [JuegoController::class, 'update'])->name('update');

    Route::get('delete/{slug}', [JuegoController::class, 'delete'])->name('delete');

    Route::post('search', [JuegoController::class, 'search'])->name('search');
});

/* Desarrolladora */
Route::get('desarrolladora/{slug}', [JuegoController::class, 'showdesarrolladora'])->name('showdesarrolladora');

/* Genero */
Route::get('genero/{slug}', [JuegoController::class, 'showgenero'])->name('showgenero');

/* Auth */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
