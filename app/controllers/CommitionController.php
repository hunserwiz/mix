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
        $section = null;
        $month = null;
        $year = null;
        $agent_id = null;
        $list_agent = User::where('user_type','=',3)->lists('name','id');

        return View::make('commition.index',compact('section','month','year','list_agent','agent_id'));
    }

    public function postReport() {
        $section = Input::get('section');        
        $month = Input::get('month');
        $year = Input::get('year') - 543;
        $agent_id = Input::get('agent_id');
        $list_agent = User::where('user_type','=',3)->lists('name','id');
        
        if($section == 1){
            $date_start = $year."-".$month."-01";
            $date_end = $year."-".$month."-16";
        }else{
            $date_start = $year."-".$month."-17";
            $date_end = $year."-".$month."-31";     
        }
                
        $year = Input::get('year');
        // loop product all //
        $model = Product::get();
        $array_result = array();
        foreach ($model as $m) {
            $array_result[$m->id]['name'] = $m->name;
            $array_result[$m->id]['amount'] = 0;
            $array_result[$m->id]['point'] = $m->point;
            $array_result[$m->id]['benefit_sender'] = $m->benefit_sender;
            $array_result[$m->id]['benefit_member'] = $m->benefit_member;
            $array_result[$m->id]['benefit_retail'] = $m->benefit_retail;
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

        $total_amount = 0;
        $total_result = 0;
        foreach ($order_model as $o) {
            $array_result[$o->product_id]['amount'] += $o->amount;
            $total_amount += $o->amount;
            $total_result += $o->amount * $array_result[$o->product_id]['benefit_sender'];
            // echo $o->product_id." : ".$array_result[$o->product_id]['amount']." : ".$array_result[$o->product_id]['benefit_sender']." : ".$total_result."<br />";
        }

        return View::make('commition.index',compact('model',
                            'array_result',
                            'list_agent',
                            'section',
                            'month',
                            'year',
                            'agent_id',
                            'total_amount',
                            'total_result',
                            'date_start',
                            'date_end'
                                    ));
    }

    
}
