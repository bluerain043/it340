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
Route::get('/', 'UserController@index');
//Rooms
Route::get('/room/add', 'RoomController@add_room');
Route::post('/room/add', 'RoomController@post_add_room');
Route::get('/room/{room}/edit', 'RoomController@room_view_edit');
Route::get('/room/{room}/{schedule}', 'RoomController@room_view_edit_schedule');
Route::post('room/save-student', 'RoomController@save_new_student');
Route::post('room/ajax-save-student', 'RoomController@ajax_save_new_student');
Route::get('/room/list', 'RoomController@list_of_room');
Route::post('room/get_room_details', 'RoomController@get_room_details');

//Specifications
Route::post('room/ajax-save-specification', 'RoomController@ajax_save_specification');
Route::post('room/ajax_save_software', 'RoomController@ajax_save_software');
Route::post('room/ajax_save_device', 'RoomController@ajax_save_device');

//Specifications in stock modal
Route::post('room/save-specification', 'RoomController@save_specification');//ajax


//Schedule
Route::get('/schedule', 'RoomController@schedule')->name('schedule');
Route::post('/schedule/add', 'RoomController@post_schedule');

//Users
Route::get('/user/create', 'UserController@create_user')->name('create_user');
Route::post('/user/create', 'UserController@post_create_user')->name('register_user');
Route::get('/user/list', 'UserController@user_list')->name('user_list');

//Return with view
Route::post('room/get_info_details', 'RoomController@get_info_details');

//Inventory
Route::get('/inventory_list/{room?}', 'InventoryController@view_list');
Route::get('/inventory_list/student/{room}', 'InventoryController@get_student');
Route::get('/inventory_list/specs/{room}', 'InventoryController@get_specification');
Route::get('/inventory_list/software/{room}', 'InventoryController@get_software');
Route::get('/inventory_list/hardware/{room}', 'InventoryController@get_hardware');
Route::post('/inventory_list/{room?}', 'InventoryController@search_student');

//User
Route::post('user/edit', 'UserController@get_user_data');
Route::post('user/edit/user', 'UserController@post_edit_user');
Route::post('user/delete/', 'UserController@delete_user');


//Schedule Edit
Route::post('/schedule/schedule_info', 'ScheduleController@get_schedule_details');
Route::post('/schedule/update/{schedule}', 'ScheduleController@post_update');
Route::post('/schedule/delete', 'ScheduleController@delete_schedule');