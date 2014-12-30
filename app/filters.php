<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) {
		if(!Request::ajax())
			return Redirect::guest('account/sign-in');
		else
			return Response::make('กรุณาเข้าสู่ระบบ', 403);
	}
});


Route::filter('admin', function()
{

	if (Auth::guest()) {
		return Redirect::guest('account/sign-in');
	}else{
		if(Request::ajax()){
			if(Auth::user()->user_type == 1){
			}else{
				return Response::make('ไม่สารมารถใช้งานในส่วนของ ผู้ดูแลระบบได้', 403);
			}
		}else{
			if(Auth::user()->user_type == 1){
			}else{
				return Response::view('errors.auth', array(
					'message' => 'ไม่สารมารถใช้งานในส่วนของ ผู้ดูแลระบบได้',
				));
			}
		}
	}
});

Route::filter('navi', function()
{

	if (Auth::guest()) {
		return Redirect::guest('account/sign-in');
	}else{
		if(Request::ajax()){

			if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2 ){
			}else{
				return Response::make('ไม่สารมารถใช้งานในส่วนของ Navigator ', 403);
			}
		}else{
			if(Auth::user()->user_type == 1 || Auth::user()->user_type == 2 ){
			}else{
				return Response::view('errors.auth', array(
					'message' => 'ไม่สารมารถใช้งานในส่วนของ Navigator ',
				));
			}
		}
	}
});

Route::filter('geo', function()
{

	if (Auth::guest()) {
		return Redirect::guest('account/sign-in');
	}else{
		if(Request::ajax()){

			if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3 ){
			}else{
				return Response::make('ไม่สารมารถใช้งานในส่วนของ Navigator ', 403);
			}
		}else{
			if(Auth::user()->user_type == 1 || Auth::user()->user_type == 3 ){
			}else{
				return Response::view('errors.auth', array(
					'message' => 'ไม่สารมารถใช้งานในส่วนของ Navigator ',
				));
			}
		}
	}
});

Route::filter('geo_shop', function($route)
{
	$shop_id = $route->getParameter('shop_id');

	if (Auth::guest()) {
		return Redirect::guest('account/sign-in');
	}else{
		if(Request::ajax()){
			if(Auth::user()->user_type == 3){
	    		$user_model = User::where('user_id','=',(Integer)Auth::user()->user_id)->first();
	    		if($user_model['permission'][0]->shop_id != $shop_id){
	    			// ถ้าไม่ใช้ร้านของตัวเอง ไม่สามารถเข้าได้
	    			return Response::make('ไม่สารมารถใช้งานร้านอื่นได้ ', 403);
	    		}
	    	}
		}else{
			if(Auth::user()->user_type == 3){
	    		$user_model = User::where('user_id','=',(Integer)Auth::user()->user_id)->first();
	    		if($user_model['permission'][0]->shop_id != $shop_id){
	    			// ถ้าไม่ใช้ร้านของตัวเอง ไม่สามารถเข้าได้
	    			return Redirect::route('geo-dashboard');
	    		}
	    	}
		}
	}
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
