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

Route::get('/', 'PreguntasControlador@index');

Auth::routes();

Route::get('/home', 'PreguntasControlador@principal');

Route::get('/contacto', 'PreguntasControlador@getContacto');

Route::get('/perfil', 'UsuariosControlador@getPerfil')->middleware('auth');



