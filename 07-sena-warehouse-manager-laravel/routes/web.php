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

// Route::get('/', function () {
//     return view('welcome');
// });

	// Auth::routes();
	// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    // Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    // Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    // Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    // Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/', 'IndexController@index')->name('index');
Route::get('/admin', 'AdminController@redirect');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::post('/admin/dashboard/import', 'AdminController@import');

Route::get('/instructorajax', 'InstructorController@ajax');

// Prestar Ambiente
Route::post('/solicitar_prestamo/{id}/aprobado', 'ClassroomController@prestamo_aprobado');
Route::post('/disponibilidad_instructor/{id_instructor}', 'InstructorController@disponibilidad_instructor');
Route::post('/disponibilidad_classgroup/{classgroup_id}', 'ClassGroupController@disponibilidad_classgroup');
Route::post('/guardar_historial', 'HistoryRecordController@store');

// Entregar Ambiente
Route::post('/entregar_ambiente/{id}/aprobado', 'ClassroomController@entrega_aprobado');
Route::post('/modificar_disponibilidad_ins/{id_instructor}', 'InstructorController@modificar_disponibilidad');
Route::post('/modificar_disponibilidad_cg/{classgroup_id}', 'ClassGroupController@modificar_disponibilidad');
Route::post('/agregar_novedad/{fecha_prestamo}', 'HistoryRecordController@agregar_novedad');

//
Route::resource('/admin/instructor','InstructorController');
Route::post('/admin/instructor/truncate', 'InstructorController@truncate');

//
Route::resource('/admin/class_group','ClassGroupController');
Route::post('/admin/class_group/truncate', 'ClassGroupController@truncate');
Route::post('/admin/class_group/import','ClassGroupController@import');

//
Route::resource('/admin/classroom','ClassroomController');
Route::post('/admin/classroom/truncate', 'ClassroomController@truncate');

//
Route::resource('/admin/history_record','HistoryRecordController');
Route::put('/admin/history_record/{id}/novedad_nueva','HistoryRecordController@agregar_nueva_novedad');
Route::get('/history_record/excel','HistoryRecordController@excel');
Route::get('admin/datesearch','HistoryRecordController@datesearch');
Route::get('admin/obtener_historial','HistoryRecordController@obtener_historial');
// Route::get('admin/obtener_novedad','HistoryRecordController@obtener_novedad');

//
Route::get('/admin/password', 'AdminController@password');
Route::post('/admin/updatepassword', 'AdminController@updatePassword');
Route::post('/admin/all_entries/truncate', 'AdminController@truncateAll');
Route::get('/admin/update_system', 'AdminController@update_system_index');

Route::get('obtener_ambiente', 'ClassroomController@obtener_ambiente');

Route::resource('/admin/collaborator', 'CollaboratorController');


// Redirección - Error 404
Route::get('error', function()
{
	return Response::view('error.error404', array(), 404);
});
