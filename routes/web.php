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

Route::get('/', function () {
    return view('home');
});

Route::resource('menu','ProductoController');
Route::resource('categorias','CategoriaController');
Route::resource('editorial','EditorialController');
Route::resource('genero','GeneroController');
Route::resource('ventas','VentaController');
Route::resource('chef','ChefController');
Route::resource('repartidor','RepartidorController');
Route::resource('ventasP','VentaPublicoController');
Route::resource('detalleCP','DetalleVentaPublicoController');
Route::resource('detalle','DetalleVentaController');
Route::resource('clientes','ClienteController');
Route::resource('usuario','UsuarioController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
