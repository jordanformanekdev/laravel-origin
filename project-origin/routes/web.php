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
Route::get('/products', function() {
  $products = App\Product::all();

  return view('products.products', compact('products'));
}) ;

/**** Projects ****/
Route::resource('projects', 'ProjectsController');

/**** Projects ****/
Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');
Route::patch('/tasks/{task}', 'ProjectTasksController@update');

/**** User Profile ****/
Route::get('/user/profile', 'UserProfileController@index');
Route::post('/profile-image/store', 'ProfileImageController@store');
Route::get('/profile-image', 'ProfileImageController@index');
Route::get('profile-image/create', 'ProfileImageController@create');

/**** User Subscription ****/
Route::get('/user/subscription', 'SubscriptionPageController@index');


/**** Webhooks ****/
Route::post('/stripe/webhook', 'WebhooksController@handle');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/purchases', 'PurchasesController@store');
Route::post('/subscriptions', 'SubscriptionsController@store');
