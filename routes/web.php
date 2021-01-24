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
    Route::get('/view/{id}', 'StudentController@view') -> name('student.view');
    Route::get('/{id}/edit', 'StudentController@edit') -> name('student.edit');
    Route::post('/update/{id}', 'StudentController@update') -> name('student.update');
    Route::get('/destroy/{id}', 'StudentController@destroy') -> name('student.destroy');
});

/**
 * staff route
 */

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'staff'], function(){
    Route::get('/', 'StaffController@index') -> name('staff.index');
    Route::post('/store', 'StaffController@store') -> name('staff.store');
    Route::get('/show', 'StaffController@show') -> name('staff.show');
    Route::get('/view/{id}', 'StaffController@view') -> name('staff.view');
    Route::get('/{id}/edit', 'StaffController@edit') -> name('staff.edit');
    Route::post('/update/{id}', 'StaffController@update') -> name('staff.update');
    Route::get('/destroy/{id}', 'StaffController@destroy') -> name('staff.destroy');
});

/**
 * staff route
 */

Route::group(['namespace' => 'App\Http\Controllers', 'prefix' => 'teacher'], function(){
    Route::get('/', 'TeacherController@index') -> name('teacher.index');
    Route::post('/store', 'TeacherController@store') -> name('teacher.store');
    Route::get('/show', 'TeacherController@show') -> name('teacher.show');
    Route::get('/view/{id}', 'TeacherController@view') -> name('teacher.view');
    Route::get('/{id}/edit', 'TeacherController@edit') -> name('teacher.edit');
    Route::post('/update/{id}', 'TeacherController@update') -> name('teacher.update');
    Route::get('/destroy/{id}', 'TeacherController@destroy') -> name('teacher.destroy');
});

