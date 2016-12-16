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
    
    Route::get('/profile/{user_id}',[
        'uses' => 'PostController@getProfilePosts',
        'as' => 'profile'
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
    
    Route::post('/like-post',[
        'uses' => 'PostController@postLikePost',
        'as' => 'like-post'
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
    
    Route::get('/delete-account/{id}',[
        'uses' => 'HomeController@getDeleteAccount',
        'as' => 'delete-account'
    ]);
    
    Route::get('/search/user',[
        'uses' => 'HomeController@getSearchUser',
        'as' => 'search-user'
    ]);
    
    Route::get('/query', 'HomeController@query');
    
    Route::get('/user/{id}',[
        'uses' => 'HomeController@getUserInformation',
        'as' => 'user'
    ]);
    
    Route::post('/comment',[
        'uses' => 'PostController@postCommentPost',
        'as' => 'comment'
    ]);
    
    Route::get('/get-comments/{post_id}',[
        'uses' => 'PostController@getCommentsPost',
        'as' => 'get-comments'
    ]);
    
});
