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

Route::prefix('juegos/')->group(function () {

    Route::get('add', function () {
        return view('add');
    })->name('add_form')->middleware('auth');

    Route::post('add', 'JuegoController@add')->name('add')->middleware('auth');

    Route::get('{slug}', 'JuegoController@show')->name('show')->middleware('auth');

    Route::post('edit', 'JuegoController@update')->name('update');

    Route::get('delete/{slug}', 'JuegoController@delete')->name('delete')->middleware('auth');

    Route::post('search', 'JuegoController@search')->name('search');
});

/* Auth */
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
