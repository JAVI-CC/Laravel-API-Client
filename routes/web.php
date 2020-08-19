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

Route::get('/juegos/add', function () {
    return view('add');
})->name('add_form')->middleware('auth');

Route::post('/juegos/add', 'JuegoController@add')->name('add')->middleware('auth');

Route::get('/juegos/{id}', 'JuegoController@show')->name('show')->middleware('auth');

Route::put('/juegos/{id}', 'JuegoController@update')->name('update');

Route::get('/juegos/delete/{id}', 'JuegoController@delete')->name('delete')->middleware('auth');

Route::post('/juegos/search', 'JuegoController@search')->name('search');

/* Auth */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
