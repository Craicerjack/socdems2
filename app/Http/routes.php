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
// CORS
header('Access-Control-Allow-Origin: http://socdems.carlostighe.com');
header('Access-Control-Allow-Credentials: true');


Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () { return view('welcome'); });

    Route::get('/users', 'UserController@index');
    Route::post('/users', 'UserController@store');
    Route::delete('/user/{user}', 'UserController@destroy');
    // Box Routes
    Route::get('/boxes', 'BoxController@index');
    Route::post('/boxes', 'BoxController@store');
    Route::delete('/box/{box}', 'BoxController@destroy');

    Route::get('/upload', function() { return view('upload'); });
    Route::post('/upload', 'UploadController@upload' );

    Route::get('/contacts', 'ContactController@index');
    Route::get('/api/contacts', 'ContactController@returnJson');
    Route::get('/contacts/add', 'ContactController@addContact');
    Route::get('/contacts/edit/{contact}', 'ContactController@editContact');
    Route::post('/contacts', 'ContactController@store');
    Route::delete('/contact/{contact}', 'ContactController@destroy');

    Route::get('/walksheets', 'WalksheetController@create');
    Route::post('/walksheets', 'WalksheetController@generate');

    // Authentication Routes...
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    // Registration Routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
});
