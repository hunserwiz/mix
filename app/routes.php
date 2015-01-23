<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'guest'), function() {

	Route::get('account/sign-in', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn',
    ));

    Route::group(array('before' => 'csrf'), function() {

        Route::post('account/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn',
        ));
    });
});
Route::group(array('before' => 'auth'), function() {

	Route::get('/','OrderController@getIndex');
	Route::get('/order','OrderController@getIndex');
    Route::get('form-order','OrderController@getForm');
    Route::get('edit-order/{order_id}','OrderController@getFormEdit');
    Route::post('delete-order','OrderController@postDelete');

    Route::get('manage-product','ProductController@getIndex');
    Route::get('form-product','ProductController@getForm');
    Route::get('edit-product/{product_id}','ProductController@getFormEdit');
    Route::post('delete-product','ProductController@postDelete');
    Route::post('search-product','ProductController@postSearch');

    Route::group(array('before' => 'csrf'), function() {
        Route::post('post-order','OrderController@postForm');
        Route::post('post-product','ProductController@postForm');
    });

    Route::get('account/sign-out','AccountController@getSignOut');
});
