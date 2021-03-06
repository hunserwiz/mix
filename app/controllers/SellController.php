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
        $agent_id = null;
        $list_agent = User::where('user_type','=',3)->lists('name','id');

        return View::make('sell.index',compact('day','month','year','list_agent','agent_id'));
    }
    public function postReport() {
        $day = Input::get('day');
        $month = Input::get('month');
        $year = Input::get('year') - 543;
        $agent_id = Input::get('agent_id');

        $date_start = $year."-".$month."-".$day;
        $date_end = $year."-".$month."-".$day;
        $year = Input::get('year');
        // loop product all //
        $model = Product::get();
        $array_result = array();
        foreach ($model as $m) {
            $array_result[$m->id]['name'] = $m->name;
            $array_result[$m->id]['amount'] = 0;
            $array_result[$m->id]['point'] = $m->point;
        }
        // loop query condition //
        $order_model = Order::join('order_item', function($join) {
            $join->on('order.order_id','=','order_item.order_id');
        })
        ->where(function($query) use ($agent_id)
        {
            if($agent_id){
                $query->where('order.agent_id','=',$agent_id);
            }else{
                $query->where('order.agent_id','=',Auth::user()->id);
            }
        })
        ->whereBetween('order.order_date',array($date_start,$date_end))
        ->get();
        $list_agent = User::where('user_type','=',3)->lists('name','id');

        $total_amount = 0;
        $total_result = 0;
        $point = 0;
        $bonus = 0;
        $salary = 0;
        $multiply = 0.08;
        foreach ($order_model as $o) {
            $array_result[$o->product_id]['amount'] = $o->amount;
            $total_amount = $total_amount + $o->amount;
            $total_result = $total_result + $array_result[$o->product_id]['amount'] * $array_result[$o->product_id]['point'];
        }
        $point = $total_result * 26;

        if($point > 10000 && $point < 14000){
            $multiply = 0.08;
        }else if($point > 14001 && $point < 18000){
            $multiply = 0.09;
        }else if($point > 18001){
            $multiply = 1;
        }
        $bonus = $point * $multiply;
        $salary = $bonus * 6;
        return View::make('sell.index',compact('model',
                            'array_result',
                            'list_agent',
                            'day','month',
                            'year',
                            'total_amount',
                            'total_result',
                            'agent_id',
                            'multiply',
                            'point',
                            'bonus',
                            'salary'
                                    ));
    }
}
