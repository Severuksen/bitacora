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

/**
 * RUTA PRINCIPAL
 */
Route::view('/', 'index')->name('index');

/**
 * RUTAS DE BUSQUEDA
 */
Route::get('/busqueda', 'GruasController@getbusqueda');
Route::post('/busqueda', 'GruasController@postbusqueda');

/**
 * RUTAS DE GRUAS
 */
Route::get('/grua/{id}', 'GruasController@getgrua');
Route::redirect('/grua','/busqueda');

/**
 * RUTAS DE MENU
*/
Route::redirect('/menu','/menu/gruas');
Route::prefix('menu')->group(function(){
    Route::get('gruas', 'GruasController@getmenu');
    Route::post('gruas', 'GruasController@postmenu');
    Route::get('mantenimiento', 'MantenimientoController@getmenu');
    Route::post('mantenimiento', 'MantenimientoController@postmenu');
    Route::get('datos', 'ManualesController@getmenu');
    Route::post('datos', 'ManualesController@postmenu');
    Route::get('manuales', 'ManualesController@getmenu');
    Route::post('manuales', 'ManualesController@postmenu');
});

/**
 * RUTA CON VUE
 */
Route::view('/vue', 'layouts.app');
