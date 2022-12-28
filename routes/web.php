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
    return view('auth/login');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::get('administracion/usuarios', 'UsuariosController@index');
	Route::resource('administracion/usuarios', 'UsuariosController');

	Route::get('/documentos/plantillas/area/{id}', 'PlantillasController@index')->name('plantillasAreas');
	Route::get('/documentos/plantillas/create/{id}', 'PlantillasController@create')->name('plantillasAreasCreate');
	Route::resource('/documentos/plantillas', 'PlantillasController');
    Route::get('/fileplantillas/download/{id}','PlantillasController@file')->name('downloadfilePlantillas');

	Route::get('documentos/procedimientos/area/{id}', 'ProcedimientosController@index')->name('procedimientosAreas');
	Route::get('documentos/procedimientos/create/{id}', 'ProcedimientosController@create')->name('procedimientosAreasCreate');
    Route::resource('documentos/procedimientos', 'ProcedimientosController');
    Route::get('/fileprocedimientos/download/{id}','ProcedimientosController@file')->name('downloadfileProcedimientos');

	Route::get('documentos/miscelaneos/area/{id}', 'MiscelaneosController@index')->name('miscelaneosAreas');
	Route::get('documentos/miscelaneos/create/{id}', 'MiscelaneosController@create')->name('miscelaneosAreasCreate');
	Route::resource('documentos/miscelaneos', 'MiscelaneosController');
	Route::get('/filemiscelaneos/download/{id}','MiscelaneosController@file')->name('downloadfileMiscelaneos');



	Route::resource('proyectos', 'ProyectosController');
    Route::get('/fileproyectos/download/{id}','ProyectosController@file')->name('downloadfileProyectos');
    
	Route::get('actividades', 'ActividadesController@index');
	Route::resource('actividades', 'ActividadesController');

	Route::resource('carpetas', 'CarpetasController');
	Route::get('proyectos/carpetas/{id}', 'CarpetasController@index')->name('carpetasProyectos');
    Route::get('proyectos/carpetas/create/{id}', 'CarpetasController@create')->name('carpetasProyectosCreate');
    Route::get('proyectos/carpetas/{proyecto}/folder/show/{id?}', 'CarpetasController@listfolder')->name('carpetasProyectosList');
	Route::get('proyectos/carpetas/folder/edit/{id}', 'CarpetasController@edit')->name('carpetasProyectosEdit');
	Route::delete('proyectos/carpetas/folder/delete/{id}', 'CarpetasController@destroyfolder')->name('carpetasProyectosDelete');
	Route::get('proyectos/carpetas/file/{id}', 'CarpetasController@file')->name('fileCarpetasProyectosCreate');
	Route::get('proyectos/carpetas/file/show/{id}', 'CarpetasController@show')->name('fileCarpetasProyectosShow');
	Route::post('proyectos/carpetas/file', 'CarpetasController@filestore')->name('fileStore');
	Route::get('file/carpetas/download/{id}','CarpetasController@downloadFile')->name('downloadArchiveProyectos');
	Route::post('select-ajax', ['as'=>'select-ajax','uses'=>'CarpetasController@carpetasSecundarias']);

	Route::resource('temporales', 'TemporalesController');
	Route::get('/filetemporales/download/{id}','TemporalesController@file')->name('downloadfileTemporales');

	Route::resource('administracion/clientes', 'ClientesController');

	Route::resource('notificaciones', 'NotificacionesController');
	Route::get('notificaciones/create/{id}', 'NotificacionesController@create')->name('notifiacionesTemporalCreate');
	Route::get('notificaciones/show/{id}', 'NotificacionesController@show')->name('notifiacionesTemporalShow');

	Route::post('notificacion-ajax', ['as'=>'notificacion-ajax','uses'=>'NotificacionesController@notificaciones']);


	Route::resource('administracion/cargos', 'CargosController');



});



