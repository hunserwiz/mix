<?php

class CommitionController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function getIndex() {
        $day = null;
        $month = null;
        $year = null;
        $agent_id = null;
        $list_agent = User::where('user_type','=',3)->lists('name','id');

        return View::make('commition.index',compact('day','month','year','list_agent','agent_id'));
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

        return View::make('commition.index',compact('model',
                            'array_result',
                            'list_agent',
                            'day',
                            'month',
                            'year',
                            'agent_id'
                                    ));
    }

    
}
