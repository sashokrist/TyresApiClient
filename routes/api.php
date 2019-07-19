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


// Route::post('login', 'Auth\LoginController@ApiLogin');
/*Route::post('login', function (Request $request) {

    if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        // Authentication passed...
        $user = auth()->user();
        $user->api_token = str_random(60);
        $user->save();
        return $user;
    }

    return response()->json([
        'error' => 'Unauthenticated user',
        'code' => 401,
    ], 401);
});

Route::middleware('auth:api')->post('logout', function (Request $request) {

    if (auth()->user()) {
        $user = auth()->user();
        $user->api_token = null; // clear api token
        $user->save();

        return response()->json([
            'message' => 'Thank you for using our application',
        ]);
    }

    return response()->json([
        'error' => 'Unable to logout user',
        'code' => 401,
    ], 401);
});*/
//Auth::routes();
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function () {
    //Route::resource('tyre', 'TyreController');
    Route::post('tyre', 'TyreController@store');
    Route::get('tyre', 'TyreController@create');
    Route::delete('tyre/{id}', 'TyreController@destroy');
    Route::get('tyre/{id}', 'TyreController@edit');
    Route::put('tyre/{id}', 'TyreController@update');

});
Route::get('tyre/{id}', 'TyreController@show');
Route::get('tyres', 'TyreController@index');
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
//Route::get('logout', 'AuthController@logout');
Route::get('search', 'TyreController@search');
//Route::get('tyres', 'TyreController@index');
//Route::get('tyre/{id}', 'TyreController@show');

//Route::get('images', 'GalleryController@index');

//Route::post('images', 'GalleryController@store');

//Route::get('manufacture', 'ManufactureController@index');

//Route::post('tyre', 'TyreController@store');

//Route::put('tyre/{id}', 'TyreController@edit');






/*Route::get('image/upload','ImageUploadController@fileCreate');
Route::post('image/upload/store','ImageUploadController@fileStore');
Route::post('image/delete','ImageUploadController@fileDestroy');*/
