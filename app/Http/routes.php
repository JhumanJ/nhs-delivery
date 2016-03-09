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

    //create delivery
    Route::post('/delivery', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@store'
    ]);
    Route::get('/deliveries-all', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@indexAll'
    ]);

    //---Manage deliveries---

    Route::delete('/delete/{delivery}', [
        'as' => 'delete',
        'middleware' => 'admin',
        'uses' => 'DeliveryController@destroy'
    ]);

    Route::post('/cancel/{delivery}', [
        'as' => 'cancel',
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@cancel'
    ]);

    Route::post('/collect/{delivery}', [
        'as' => 'collect',
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@collect'
    ]);

    Route::post('/edit', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@edit'
    ]);

    //--------AJAX--------

    //Search for user when add package
    Route::get('/search/user/{search}', [
        'middleware' => 'receptionnist',
        'uses' => 'UserController@indexSearchAjax'
    ]);

    //Search for delivery on user page
    Route::get('/search/delivery/{search}', [
        'middleware' => 'auth',
        'uses' => 'DeliveryController@indexSearchAjax'
    ]);



});
