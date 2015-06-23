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
    Route::get('get-tbl-order-item','OrderController@getTableOrderItem');
	Route::get('/order','OrderController@getIndex');
    Route::post('product-order-item','OrderController@postIndexItem');
    Route::get('form-order','OrderController@getForm');
    Route::get('edit-order/{order_id}','OrderController@getFormEdit');
    Route::post('delete-order','OrderController@postDelete');
    Route::post('search-order','OrderController@postSearch');
    Route::post('post-product-name','OrderController@postProductName');
    Route::post('view-order','OrderController@postView');
    Route::post('post-add-order-item','OrderController@postFormItem');
    Route::post('delete-product-order-item','OrderController@postDeleteitem');
    // order-report
    Route::get('order-report/{order_id}','OrderReportController@getReport');
    Route::get('order-report-pdf/{order_id}','OrderReportController@getReportPDF');    
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
    // sell
    Route::get('sell','SellController@getIndex');
    // product
    Route::get('manage-product','ProductController@getIndex');
    Route::get('form-product','ProductController@getForm');
    Route::get('edit-product/{product_id}','ProductController@getFormEdit');
    Route::post('delete-product','ProductController@postDelete');
    Route::post('search-product','ProductController@postSearch');
    // product-return
    Route::get('product-return','ProductReturnController@getIndex');
    Route::post('product-return-item','ProductReturnController@postIndexItem');
    Route::get('form-product-return','ProductReturnController@getForm');
    Route::get('edit-product-return/{id}','ProductReturnController@getFormEdit');
    Route::post('delete-product-return','ProductReturnController@postDelete');
    Route::post('delete-product-return-item','ProductReturnController@postDeleteitem');
    Route::post('search-product-return','ProductReturnController@postSearch');
    Route::post('get-list-product','ProductReturnController@getListProduct');
    Route::post('view-product-return','ProductReturnController@postView');
    Route::post('post-add-return-item','ProductReturnController@postFormItem');
    
    // commition
    Route::get('commition','CommitionController@getIndex');
    // deposit
    Route::get('deposit','DepositController@getIndex');
    Route::post('deposit-item','DepositController@postIndexItem');
    Route::get('form-deposit','DepositController@getForm');
    Route::get('edit-deposit/{id}','DepositController@getFormEdit');
    Route::post('delete-deposit','DepositController@postDelete');
    Route::post('delete-deposit-item','DepositController@postDeleteitem');
    Route::post('search-deposit','DepositController@postSearch');
    Route::post('view-deposit','DepositController@postView');
    Route::post('post-add-deposit-item','DepositController@postFormItem');
    // user
    Route::get('manage-user','UserController@getIndex');
    Route::get('form-user','UserController@getForm');
    Route::get('edit-user/{id}','UserController@getFormEdit');
    Route::post('search-user','UserController@postSearch');
    Route::post('delete-user','UserController@postDelete');
    // webboard
    Route::get('manage-webboard','WebboardController@getIndex');
    Route::get('form-webboard','WebboardController@getForm');
    Route::get('edit-webboard/{id}','WebboardController@getFormEdit');
    Route::get('comment-webboard/{id}','WebboardController@getComment');
    Route::post('search-webboard','WebboardController@postSearch');
    Route::post('delete-webboard','WebboardController@postDelete');
    // form //
    Route::group(array('before' => 'csrf'), function() {        
        Route::post('post-order','OrderController@postForm');
        Route::post('post-finance','FinanceController@postForm');
        Route::post('post-user','UserController@postForm');
        Route::post('post-debtor','DebtorController@postForm');
        Route::post('post-sell','SellController@postReport');
        Route::post('post-order-report','OrderReportController@postReport');
        Route::post('post-commition','CommitionController@postReport');
        Route::post('post-product','ProductController@postForm');
        Route::post('post-product-return','ProductReturnController@postForm');
        Route::post('post-deposit','DepositController@postForm');
        Route::post('post-webboard','WebboardController@postForm');
        Route::post('post-comment','WebboardController@postFormComment');
    });

    Route::get('account/sign-out','AccountController@getSignOut');
});
