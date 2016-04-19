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

    Route::get('/create', [
        'middleware' => 'receptionnist',
        'uses' => 'UserController@addDelivery'
    ]);

    Route::get('/deliveries', [
        'middleware' => 'auth',
        'uses' => 'DeliveryController@index'
    ]);

    //img
    Route::get('/image/delivery/{id}', ['middleware' => 'auth', function($id) {
        $img = Image::make(storage_path().'/app/public/img/deliveries/'.$id.'.jpg');
        return $img->response('jpg');
    }]);

    Route::get('/image/signature/{id}', ['middleware' => 'auth', function($id) {
        $img = Image::make(storage_path().'/app/public/img/signatures/'.$id.'.png');
        return $img->response('png');
    }]);

    //profile routes
    Route::get('/profile', [
        'middleware' => 'auth',
        'uses' => 'UserController@getProfile'
    ]);

    Route::post('/profile', [
        'middleware' => 'auth',
        'uses' => 'UserController@updateProfile'
    ]);


    //create delivery
    Route::post('/delivery', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@store'
    ]);

    Route::get('/deliveries-all', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@indexAll'
    ]);

    Route::get('/deliveries-awaiting', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@awaiting'
    ]);


    Route::get('/deliveries-past', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@past'
    ]);


    Route::get('/deliveries-cancelled', [
        'middleware' => 'receptionnist',
        'uses' => 'DeliveryController@cancelled'
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
