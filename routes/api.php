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

//client account routes
Route::middleware('auth:api')->get('v1/client_accounts', 'API\V1\ClientAccountController@clientAccounts');
Route::middleware('auth:api')->post('v1/client_accounts/store', 'API\V1\ClientAccountController@store');

//project routes
Route::middleware('auth:api')->get('v1/projects', 'API\V1\ProjectController@projects');
Route::middleware('auth:api')->post('v1/projects/store', 'API\V1\ProjectController@store');

//position routes
Route::middleware('auth:api')->get('v1/positions', 'API\V1\PositionController@positions');
Route::middleware('auth:api')->post('v1/positions/store', 'API\V1\PositionController@store');

//task type routes
Route::middleware('auth:api')->get('v1/task_types', 'API\V1\TaskTypeController@taskTypes');
Route::middleware('auth:api')->post('v1/task_types/store', 'API\V1\TaskTypeController@store');

//work routes
Route::middleware('auth:api')->get('v1/works', 'API\V1\ProjectDetailController@works');
Route::middleware('auth:api')->post('v1/works/store', 'API\V1\ProjectDetailController@store');

//purchase type routes
Route::middleware('auth:api')->get('v1/purchase_types', 'API\V1\PurchaseTypeController@purchaseTypes');
Route::middleware('auth:api')->post('v1/purchase_types/store', 'API\V1\PurchaseTypeController@store');

//purchase routes
Route::middleware('auth:api')->get('v1/purchases', 'API\V1\PurchaseController@purchases');
Route::middleware('auth:api')->post('v1/purchases/store', 'API\V1\PurchaseController@store');
Route::middleware('auth:api')->get('v1/purchases/project_details', 'API\V1\PurchaseController@projectDetails');
Route::middleware('auth:api')->get('v1/purchases/purchase_types', 'API\V1\PurchaseController@purchaseTypes');

//leave request routes
Route::middleware('auth:api')->get('v1/leave_requests', 'API\V1\LeaveRequestController@leaveRequests');
Route::middleware('auth:api')->post('v1/leave_requests/store', 'API\V1\LeaveRequestController@store');


//dashboard routes
Route::middleware('auth:api')->get('v1/dashboards', 'API\V1\DashboardController@dashboards');
