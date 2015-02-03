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
        $day = null;
        $month = null;
        $year = null;
        return View::make('sell.index',compact('day','month','year'));
    }
    public function postReport() {
        $day = Input::get('day');
        $month = Input::get('month');
        $year = Input::get('year') - 543;

        $date_start = $year."-".$month."-".$day;
        $date_end = $year."-".$month."-".$day;
        $year = Input::get('year');
        // loop product all //
        $model = Product::get();
        $array_result = array();
        foreach ($model as $m) {
            $array_result[$m->product_id]['name'] = $m->name;
            $array_result[$m->product_id]['amount'] = 0;
            $array_result[$m->product_id]['point'] = $m->point;
        }
        // loop query condition //
        $product_model = Product::join('orders', function($join) {
            $join->on('products.product_id', '=', 'orders.product_id');
        })
        ->where('orders.agent_id','=',Auth::user()->id)
        ->whereBetween('orders.order_date',array($date_start,$date_end))
        ->get();

        $total_amount = 0;
        $total_result = 0;
        foreach ($product_model as $p) {
            $array_result[$p->product_id]['name'] = $p->name;
            $array_result[$p->product_id]['amount'] = $p->amount_total;
            $total_amount = $total_amount + $p->amount_total;
            $total_result = $total_result + $array_result[$p->product_id]['amount'] * $array_result[$p->product_id]['point'];
        }

        return View::make('sell.index',compact('model','array_result','day','month','year','total_amount','total_result'));
    }
}
