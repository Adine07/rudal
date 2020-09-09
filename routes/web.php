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
    return redirect('/login');
});

Route::get('/login', 'AuthController@login');
Route::get('/register', 'AuthController@register');
Route::post('/login', 'AuthController@loginProccess');
Route::post('/register', 'AuthController@registerProccess');
Route::post('/logout', 'AuthController@logout');


Route::middleware('auth')->group(function () {
    Route::get('/admin/home', 'HomeController@index')->name('home');

    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::resource('/categories', 'CategoryController');
        Route::resource('/menus', 'MenuController');
        Route::resource('/ingredients', 'IngredientController');
        Route::resource('/orders', 'OrderController');
        Route::resource('/users', 'UserController');
    });
});
