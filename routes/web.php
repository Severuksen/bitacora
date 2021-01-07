<?php

use App\Http\Controllers\GruasController;
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
Route::get('/', function(){
    return view('index');
});

/**
 * RUTAS DE BUSQUEDA
 */
Route::get('busqueda', 'GruasController@getbusqueda');
Route::post('busqueda', 'GruasController@postbusqueda');

/**
 * RUTAS DE GRUAS
 */
Route::get('grua/{id}', function($id){
    $clase = new GruasController();
    return $clase->getgruas($id);
});

