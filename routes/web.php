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
    return view('pages.welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    
    Route::resource('/batch', 'BatchController');

    Route::get('/students/changepic', 'StudentController@changepic')->name('changepic');;   
    
    Route::resource('/students', 'StudentController');
    
    Route::resource('/user', 'UserController');

});

Route::resource('/attendance', 'AttendanceController');




