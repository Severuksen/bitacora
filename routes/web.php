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
Route::get('/', function(){
    return view('index');
});

/**
 * RUTAS DE BUSQUEDA
 */
Route::get('busqueda', function(){
    return view('busqueda');
});
Route::post('busqueda', function(){
    return view('busqueda');
});
