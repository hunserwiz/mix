<?php

class SellController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex() {
        $list_day = Date::getDayInMon();
        $list_month = Date::getDayInMon();
        $list_year = Date::getDayInMon();
        $model = null;
        return View::make('sell.index',compact('model','list_day','list_month','list_year'));
    }

}
