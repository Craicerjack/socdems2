<?php

use App\Box;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

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

    // Route::get('/login', function () { return view('login');});

    // List all boxes
    Route::get('/boxes', function () {
        $boxes = Box::orderBy('created_at', 'asc')->get();
        return view('box', ['boxes' => $boxes]);
    });
    // Add new box
    Route::post('/boxes', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('/boxes')->withInput()->withErrors($validator);
        }
        $box = new Box;
        $box->name = $request->name;
        $box->save();
        return redirect('/boxes');
    });
    // Delete a box
    Route::delete('/box/{box}', function (Box $box) {
        $box->delete();
        return redirect('/boxes');
    });

});
