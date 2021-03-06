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

Route::get('proceso','EventoController@get_eventos');

Route::get('asesores','AsesorController@get_asesores');
Route::post('get_asesores','AsesorController@ajax_asesores');

Route::get('clientes','ClienteController@get_clientes');
Route::post('get_clientes','ClienteController@ajax_clientes');

Route::get('eventos','EventoController@get_eventos');
Route::post('get_evento','EventoController@ajax_eventos');

Route::post('importar','ArchivoController@post_importar');

Route::get('evento/{id}', 'EventoController@getevento')->where('id', '[0-9]+');
Route::get('evento/asesor/{id}', 'EventoController@get_evento_asesor')->where('id', '[0-9]+');
Route::get('evento/cliente/{id}', 'EventoController@get_evento_cliente')->where('id', '[0-9]+');

Route::get('cliente/{id}', 'ClienteController@getcliente')->where('id', '[0-9]+');

Route::get('asesor/{id}', 'AsesorController@getasesor')->where('id', '[0-9]+');

Route::post('reporte','ReporteController@post_data');
Route::get('reporte','ReporteController@get_data');
