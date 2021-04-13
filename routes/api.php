<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');
/**
 * User API
 */

Route::get(
    'users/{user}/contacts/',
    [
        'uses' => 'API\UserController@contacts',
        'as' => 'user.contacts',
    ]
);

/**
 * Messages API
 */

Route::post(
    'messages',
    [
        'uses' => 'API\MessageController@store',
        'as' => 'messages.store',
    ]
);

Route::get(
    'messages/{user}',
    [
        'uses' => 'API\MessageController@index',
        'as' => 'messages.index',
    ]
);

Route::get(
    'messages/{user1}/{user2}',
    [
        'uses' => 'API\MessageController@show',
        'as' => 'messages.show',
    ]
);
