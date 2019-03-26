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

Route::post('/home/enviando', 'PreguntasControlador@sendPregunta');

Route::post('/buscar', 'UsuariosControlador@buscar');

// En este caso solo quiero que devuelva la vista de busqueda de los usuarios
Route::view('/busqueda-usuarios', 'usuarios.busqueda-usuarios');

// Y entes la vista de busqueda de los temas
Route::view('/busqueda-temas', 'usuarios.busqueda-temas');

Route::get('/temas/{tema}', 'PreguntasControlador@preguntasTema');

Route::get('/home/ordenar-likes', 'PreguntasControlador@ordenarLikesHome');

Route::get('/home/ordenar-recientes', 'PreguntasControlador@ordenarRecientesHome');

Route::get('/eliminar-pregunta/{id_pregunta}', 'PreguntasControlador@eliminarPregunta')->middleware('auth');

Route::post('/preguntas/{id}/accion', 'PreguntasControlador@actuarPregunta')->middleware('auth');

Route::post('/like/{id_pregunta}', ['as' => 'like', 'uses' => 'PreguntasControlador@accionLike'])->middleware('auth');


Route::get('/contacto', 'UsuariosControlador@getContacto');

Route::post('/envio-contacto', 'UsuariosControlador@sendContacto');

Route::get('/perfil-publico/{nombre}', 'UsuariosControlador@getPerfilPublico');

Route::get('/perfil', 'UsuariosControlador@getPerfil')->middleware('auth');

Route::get('/editar-perfil', 'UsuariosControlador@editPerfil')->middleware('auth');

Route::post('/editando', 'UsuariosControlador@makeEdit')->middleware('auth');

Route::get('/tus-preguntas', 'UsuariosControlador@tusPreguntas')->middleware('auth');

Route::get('/tus-preguntas-realizadas', 'UsuariosControlador@preguntasRealizadas')->middleware('auth');




