<?php

use App\Box;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () { return view('welcome'); });

    // Box Routes
    Route::get('/boxes', 'BoxController@index');
    Route::post('/boxes', 'BoxController@store');
    Route::delete('/box/{box}', 'BoxController@destroy');

    Route::get('/upload', function() { return view('upload'); });
    Route::post('/upload', 'UploadController@upload' );

    // Authentication Routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    // Registration Routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
});
