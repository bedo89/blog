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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('testo', function (){
    //dd('helllo');
});
//Route::get('posts', 'PostController@index');

Route::apiResource('categories', 'CategoryController');
Route::get('category/{slug}/posts', 'PostController@categoryPosts');
Route::get('searchposts/{query}', 'PostController@searchposts');
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('posts', 'PostController');
    Route::get('user', 'UserController@details');
});
