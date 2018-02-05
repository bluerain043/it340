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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
//Rooms
Route::get('/add-room', 'RoomController@add_room');
Route::post('/add-room', 'RoomController@post_add_room');
Route::get('/room/{room}/edit', 'RoomController@room_view_edit');
Route::get('/room/{room}/{schedule}', 'RoomController@room_view_edit_schedule');
Route::post('room/save-student', 'RoomController@save_new_student');
Route::post('room/ajax-save-student', 'RoomController@ajax_save_new_student');

//Schedule
Route::get('/schedule', 'RoomController@schedule')->name('schedule');
Route::post('/schedule/add', 'RoomController@post_schedule');