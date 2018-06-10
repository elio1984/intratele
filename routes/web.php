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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('acceso');
});
Route::get('/amenu', function () {
    return view('menu');
});
Route::get('recuperarpwd', function () {
    return view('recuperapwd');
});
Route::get('ordenes', function () {
    return view('vwordenespro');
});
Route::get('cotizaciones', function () {
    return view('vwcotizaciones');
});
Route::get('/ofertas', 'telenetcontrol@listarofertas');
Route::get('/atenciones', 'telenetcontrol@listaratenciones');
Route::post('/accesasite', 'controlsite@accesarsite');
Route::post('/detallaate', 'telenetcontrol@detallarate');
Route::post('/guardate', 'telenetcontrol@guardarate');
Route::post('/guardaoferta', 'telenetcontrol@guardaroferta');


Route::get('/salida', 'controlsite@salirsite');
Route::post('/registrausuario','controlsite@registrarusuario');
