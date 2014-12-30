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

	Route::get('/','BillController@getIndex');
	Route::get('/bill','BillController@getIndex');
  

    Route::get('manage-product','ProductController@getIndex');
    Route::get('form-product','ProductController@getform');
    Route::group(array('before' => 'csrf'), function() {
        Route::post('form-product','ProductController@postform');
    });
    Route::get('account/sign-out','AccountController@getSignOut');

 

});
