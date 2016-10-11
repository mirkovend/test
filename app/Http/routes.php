<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

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

Route::get('/casefiles', function () {
    return view('casefilespage');
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->get('test', function () {
        return 'It is ok';
    });
});
// ['middleware' => 'api.auth']
$api->version('v1', [], function ($api) {
    $api->get('users', 'App\Http\Controllers\Api\UserController@getUsers');

    $api->group([], function ($api) {
		// $api->get('cases', 'App\Api\V1\Controllers\CasesController@index');
		// $api->get('cases/{id}', 'App\Api\V1\Controllers\CasesController@show');
		// $api->post('cases', 'App\Api\V1\Controllers\CasesController@store');
		// $api->put('cases/{id}', 'App\Api\V1\Controllers\CasesController@update');
		// $api->delete('cases/{id}', 'App\Api\V1\Controllers\CasesController@destroy');
		$api->resource('cases', 'App\Http\Controllers\Api\CasesController');
	});
});

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
