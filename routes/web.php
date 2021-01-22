<?php

use Illuminate\Support\Facades\Route;

/**
 * create home route
 */
Route::get('/', function(){
    return view('welcome');
}) -> name('ajax.index');

/**
 * student route
 */

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'student'], function(){
    Route::get('/', 'StudentController@index') -> name('student.index');
    Route::post('/store', 'StudentController@store') -> name('student.store');
    Route::get('/show', 'StudentController@show') -> name('student.show');
});
