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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'AuthController@index')->name('home');
Route::get('/admin', 'AdminPageController@home')->name('adminHome');
Route::get('/admin/profile','AdminPageController@profile')->name('adminProfile');
Route::get('/admin/event','AdminPageController@tourPage')->name('tourPage');
Route::post('/admin/add/picture','AdminPageController@uploadPhoto')->name('uploadPhoto');
Route::post('/admin/event/create','AdminPageController@createEvent')->name('createEvent');
Route::post('/admin/event/edit','AdminPageController@editEventPage')->name('editEventPage');
Route::post('/admin/event/edit/image','AdminPageController@editEventImage')->name('editEventImage');
Route::delete('/admin/event/delete','AdminPageController@deleteEvent')->name('deleteEvent');

Route::get('/admin/info','AdminPageController@infoPage')->name('infoPage');