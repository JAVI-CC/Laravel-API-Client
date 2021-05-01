<?php

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

Route::get('/', 'JuegoController@index')->name('juegos.index');

Route::prefix('auth/')->group(function () {
    //Route::post('register', 'AuthController@register')->name('register');
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::get('userinfo', 'AuthController@userinfo')->name('userinfo');
});

Route::prefix('juegos/')->group(function () {

    Route::get('add', function () {
        return view('add');
    })->name('add_form');

    Route::post('add', 'JuegoController@add')->name('add');

    Route::get('{slug}', 'JuegoController@show')->name('show');

    Route::post('edit', 'JuegoController@update')->name('update');

    Route::get('delete/{slug}', 'JuegoController@delete')->name('delete');

    Route::post('search', 'JuegoController@search')->name('search');
});

/* Desarrolladora */
Route::get('desarrolladora/{slug}', 'JuegoController@showdesarrolladora')->name('showdesarrolladora');

/* Auth */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
