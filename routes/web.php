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
    return view('welcome');
});


route::get('tareas', 'TareasController@index');
Route::post('tareas', 'TareasController@store')->name('tareas.store');

Route::post('tareas', 'TareasController@modificar')->name('tareas.modificar');
