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

//trust client route
Route::get('v1/trust_client_token', 'API\V1\TrustClientController@getTrustClientToken');

//auth routes
Route::middleware('client')->post('v1/login', 'API\V1\AuthController@login');
Route::middleware('auth:api')->post('v1/logout', 'API\V1\AuthController@logout');
Route::middleware('auth:api')->get('v1/user', 'API\V1\AuthController@user');
Route::middleware('client')->post('v1/issue_new_access_token', 'API\V1\AuthController@issueNewAccessToken');


//user routes
Route::middleware('auth:api')->get('v1/users', 'API\V1\UserController@users');
Route::middleware('auth:api')->post('v1/users/store', 'API\V1\UserController@store');

//client routes
Route::middleware('auth:api')->get('v1/clients', 'API\V1\ClientController@clients');
Route::middleware('auth:api')->post('v1/clients/store', 'API\V1\ClientController@store');

//role routes
Route::middleware('auth:api')->get('v1/roles', 'API\V1\RoleController@roles');
Route::middleware('auth:api')->post('v1/roles/store', 'API\V1\RoleController@store');
