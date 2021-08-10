<?php

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

Route::get('/', function () {
    return view('index');
})->name('login');

Route::resource('user', 'App\Http\Controllers\UserController');
Route::middleware('checkSession')->resource('categorias', 'App\Http\Controllers\CategoriaController');
Route::middleware('checkSession')->resource('produtos', 'App\Http\Controllers\ProdutoController');
Route::middleware('checkSession')->resource('home', 'App\Http\Controllers\DashController');

Route::post('/usuario/login', 'App\Http\Controllers\UserController@checkLogin')->name('usuario.login');
Route::get('/usuario/logout', 'App\Http\Controllers\UserController@sair')->name('usuario.logout');



