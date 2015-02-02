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
    // order
	Route::get('/','OrderController@getIndex');
	Route::get('/order','OrderController@getIndex');
    Route::get('form-order','OrderController@getForm');
    Route::get('edit-order/{order_id}','OrderController@getFormEdit');
    Route::post('delete-order','OrderController@postDelete');
    Route::post('search-order','OrderController@postSearch');
    // finance
    Route::get('finance','FinanceController@getIndex');
    Route::get('form-finance','FinanceController@getForm');
    Route::get('edit-finance/{id}','FinanceController@getFormEdit');
    Route::post('delete-finance','FinanceController@postDelete');
    Route::post('search-finance','FinanceController@postSearch');
    // debtor
    Route::get('debtor','DebtorController@getIndex');
    Route::get('form-debtor','DebtorController@getForm');
    Route::get('edit-debtor/{id}','DebtorController@getFormEdit');
    Route::post('delete-debtor','DebtorController@postDelete');
    Route::post('search-debtor','DebtorController@postSearch');

    Route::get('sell','SellController@getIndex');

    Route::get('manage-product','ProductController@getIndex');
    Route::get('form-product','ProductController@getForm');
    Route::get('edit-product/{product_id}','ProductController@getFormEdit');
    Route::post('delete-product','ProductController@postDelete');
    Route::post('search-product','ProductController@postSearch');

    Route::group(array('before' => 'csrf'), function() {        
        Route::post('post-order','OrderController@postForm');
        Route::post('post-finance','FinanceController@postForm');
        Route::post('post-debtor','DebtorController@postForm');
        Route::post('post-product','ProductController@postForm');
    });

    Route::get('account/sign-out','AccountController@getSignOut');
});
