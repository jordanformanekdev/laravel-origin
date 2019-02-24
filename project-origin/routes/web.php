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

/*
  GET /projects (index)
  GET /projects/create  (create)
  GET /projects/(id) (show)
  GET /projects/(id)/edit (edit)

  POST /projects (store)

  PATCH /projects/(id) (update)

  DELETE /projects/(id) (destroy)
*/


/**** Pages ****/
Route::get('/', 'PagesController@home');
Route::get('/about', 'PagesController@about');

/**** Projects ****/
Route::resource('projects', 'ProjectsController');

/**** Projects ****/
Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}', 'ProjectTasksController@update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
