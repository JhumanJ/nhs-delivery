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

    Route::get('/', function () {
        return view('welcome');
    });

    Route::auth();

    Route::get('/create','UserController@addDelivery');


    Route::get('/deliveries', 'DeliveryController@index');
    //post needs a formular
    Route::post('/delivery', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@store'
    ]);
    Route::get('/deliveries-all', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@indexAll'
    ]);

    //Route::delete('/delivery/{task}', 'DeliveryController@destroy');

    //--------AJAX--------
    Route::get('/user-ajax/{search}', [
        'middleware' => 'receptionnist',
        'uses' => 'UserController@userAjax'
    ]);


});
