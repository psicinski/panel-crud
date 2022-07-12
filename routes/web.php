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

Route::get('/', 'LoginController@index');
Route::post('/', [
    'uses' => 'LoginController@login',
    'as' => 'panel.login'
]);
Route::group(['middleware'=> ['auth']], function() {
    Route::get('/main', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::post('/create', [
        'uses' => 'UserController@store',
        'as' => 'panel.create'
    ]);
    Route::delete('/main/{id}', 'UserController@destroy');
    Route::get('/edit/{id}', 'UserController@edit');
    Route::put('/edit', [
        'uses' => 'UserController@update',
        'as' => 'panel.edit'
    ]);
    Route::get('/logout', 'LoginController@logout');
});
