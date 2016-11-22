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
     
});

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
    return view('welcome');
    });
    
    Route::auth();

    Route::get('/home', [
        'uses' => 'PostController@index',
        'as' => 'home',
        'middleware' => 'auth'
    ]);
    
    Route::post('/createpost', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'createpost',
        'middleware' => 'auth'
    ]);
    
    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'delete-post',
        'middleware' => 'auth'
    ]);
    
    Route::post('/edit-post', [
        'uses' => 'PostController@postEditPost',
        'as' => "edit"
    ]);
    
    Route::get('/account', [
        'uses' => 'HomeController@getAccount',
        'as' => 'account'
    ]);
    
    Route::post('accountupdate', [
        'uses' => 'HomeController@postUpdateAccount',
        'as' => 'accountupdate'
    ]);
    
    Route::get('/account-image/{filename}',[
        'uses' => 'HomeController@getUserImage',
        'as' => 'account-image'
    ]);
    
    Route::get('/account/delete-image/{filename}', [
        'uses' => 'HomeController@getImageDelete',
        'as' => 'delete-image'
    ]);
});
