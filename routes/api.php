<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('students', 'StudentController@store');

Route::post('login', "AuthController@login");

Route::middleware('auth:api')->get('courses',"CourseController@index");

Route::middleware('auth:api')->post('registrations',"RegistrationController@store");

Route::get('login', function(){
    return view('welcome');
})->name("login");
