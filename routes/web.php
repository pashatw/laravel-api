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

Route::get('/', "App\Http\Controllers\DefaultController@index")->name('dashboard');

// section
Route::get('/section', "App\Http\Controllers\DefaultController@section")->name('section');
Route::get('/section/{id?}', "App\Http\Controllers\DefaultController@sectionDetail")->name('section.detail');
Route::get('/section/add', "App\Http\Controllers\DefaultController@sectionAdd")->name('section.add');
Route::get('/section/edit/{id?}', "App\Http\Controllers\DefaultController@sectionEdit")->name('section.edit');

// task
Route::get('/task', "App\Http\Controllers\DefaultController@task")->name('task');
Route::get('/task/add', "App\Http\Controllers\DefaultController@taskAdd")->name('task.add');
Route::get('/task/edit/{id?}', "App\Http\Controllers\DefaultController@taskEdit")->name('task.edit');

// ajax
Route::group(['prefix' => 'ajax'], function () {
	// section
	Route::post('/section/get-all', 'App\Http\Controllers\ApiWeb\SectionController@getAll')->name('ajax.section.get_all');
	Route::post('/section/get-by-id', 'App\Http\Controllers\ApiWeb\SectionController@getById')->name('ajax.section.get_by_id');
	Route::post('/section/save', 'App\Http\Controllers\ApiWeb\SectionController@save')->name('ajax.section.save');
	Route::post('/section/delete', 'App\Http\Controllers\ApiWeb\SectionController@delete')->name('ajax.section.delete');

	// task
	Route::post('/task/get-all', 'App\Http\Controllers\ApiWeb\TaskController@getAll')->name('ajax.task.get_all');
	Route::post('/task/get-by-id', 'App\Http\Controllers\ApiWeb\TaskController@getById')->name('ajax.task.get_by_id');
	Route::post('/task/save', 'App\Http\Controllers\ApiWeb\TaskController@save')->name('ajax.task.save');
	Route::post('/task/delete', 'App\Http\Controllers\ApiWeb\TaskController@delete')->name('ajax.task.delete');
});

