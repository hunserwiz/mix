<?php

class OrderReportController extends BaseController {

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
    public function getReport($order_id) {
        $model = Order::find($order_id);
        $model_item = Order::find($order_id)->orderItem()->get();
        $total = 0;
        return View::make('orderReport.reportPDF',compact('model','model_item','total'));
    }

    public function getReportPDF($order_id) {
        $model = Order::find($order_id);
        $model_item = Order::find($order_id)->orderItem()->get();
        $total = 0;
        include("mpdf/mpdf.php");
        $mpdf=new mPDF('th_sarabun', 'A4', 0, 'thsarabun'); 
        $mpdf->SetAutoFont();
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($stylesheet,1); 
        $mpdf->WriteHTML(PDFHelper::Html($model,$model_item,$total));
        $mpdf->Output();
        exit;
    }

	public function getIndex() {
        $day = null;
        $month = null;
        $year = null;
        $agent_id = null;
        $list_agent = User::where('user_type','=',3)->lists('name','id');

        return View::make('orderReport.index',compact('day','month','year','list_agent','agent_id'));
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
            // $array_result[$o->product_id]['name'] = $o->name;
            $array_result[$o->product_id]['amount'] = $o->amount;
            $total_amount = $total_amount + $o->amountl;
            $total_result = $total_result + $array_result[$o->product_id]['amount'] * $array_result[$o->product_id]['point'];
        }
    

        return View::make('orderReport.index',compact('model',
                            'array_result',
                            'list_agent',
                            'day','month',
                            'year',
                            'total_amount',
                            'total_result',
                            'agent_id'                         
                                    ));
    }
}
