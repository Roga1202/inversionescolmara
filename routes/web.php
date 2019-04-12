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

Route::get('proceso','IndexController@get_home');

Route::get('asesores','AsesorController@get_asesores');
Route::get('archivos/asesor','AsesorController@get_archivos');

Route::get('clientes','ClienteController@get_clientes');
Route::get('archivos/cliente','ClienteController@get_archivos');

Route::get('eventos','EventoController@get_eventos');
Route::get('archivos/evento','EventoController@get_archivos');

Route::post('importar','ArchivoController@post_importar');

