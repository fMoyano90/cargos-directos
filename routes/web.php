<?php

/*
GET: Conseguir datos 
POST: Guardar datos 
PUT: Actualizar datos
DELETE: Eliminar datos
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Importar CSV
Route::post('/import', 'HomeController@import')->name('import');
// Listado de usuarios
Route::get('/usuarios', 'UsuarioController@index')->name('usuarios');
// Listado de historial
Route::get('/historial', 'HistorialController@index')->name('historial');
// Listado de pendientes
Route::get('/pendientes', 'PendienteController@index')->name('pendientes');
// Listado de vencidos
Route::get('/vencidos', 'VencidoController@index')->name('vencidos');
// Borrar usuario
Route::get('/delete-usuario/{id}', 'UsuarioController@delete');
// Borrar cargo
Route::get('/delete-cargo/{id}', 'HistorialController@delete');
// Editar usuario
Route::post('/actualizar-usuario/{id}', 'UsuarioController@update')->name('actualizar-usuario');

// Buscador
Route::get('/buscar/{search?}', [
    'as' => 'cargoSearch',
    'uses' => 'PendienteController@search'
]);

Route::get('/enviar-correos', 'HomeController@emails')->name('enviar-correos');

Route::get('/pendientes/export', 'PendienteController@export')->name('exportar-pendientes');
Route::get('/vencidos/export', 'VencidoController@export')->name('exportar-vencidos');
