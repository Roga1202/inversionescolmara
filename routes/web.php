<?php

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

Route::get('/','IndexController@get_index');

Route::get('/proceso','IndexController@get_home');

Route::get('/importar/cliente','ClienteController@post_importar_cliente');
Route::get('/importar/asesor','AsesorController@post_importar_asesor');
Route::get('/importar/evento','EventoController@post_importar_evento');
