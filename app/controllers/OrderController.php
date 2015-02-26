<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderController extends BaseController {

    public function getIndex() {
    	$keyword = "";
        $keydate = "";

        $arr_page = array(
            'order' => 1
        );

        $arr_perpage = array(
            'order' => 10
        );
        $skip = ($arr_page['order'] - 1) * $arr_perpage['order'];

        $model = Order::orderBy('created_at', 'desc')->skip($skip)->take($arr_perpage['order'])->get();

        $count_model = Order::count();                

        $arr_count_page['order'] = ceil($count_model/$arr_perpage['order']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['order'],$arr_count_page['order']);

        return View::make('order.index',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keydate',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
                                        ));
    }

    public function postIndexItem() {
        $model = Order::find(Input::get('order_id'));
        $model_item = OrderItem::where("order_id","=",Input::get('order_id'))->get();
        $mode = Input::get('mode');
        return View::make('order._tbl_item',compact('model','model_item','mode'));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');
        $keydate = Input::get('keydate');
        $keydate = ThaiHelper::DateToDB($keydate);

        $arr_page = array(
            'order' => Input::get('page')
        );

        $arr_perpage = array(
            'order' => Input::get('perpage')
        );
        $skip = ($arr_page['order'] - 1) * $arr_perpage['order'];

        $model = Order::where(function($query) use ($keyword,$keydate)
        {
           if($keyword){
                $query->where('order_title','LIKE',"%".$keyword."%")
                ->orWhere('order_no','LIKE',"%".$keyword."%");
            }
            if($keydate){
                $query->where('order_date','=',$keydate);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['order'])->get();

        $count_model = Order::where(function($query) use ($keyword,$keydate)
        {
            if($keyword){
                $query->where('order_title','LIKE',"%".$keyword."%")
                ->orWhere('order_no','LIKE',"%".$keyword."%");
            }
            if($keydate){
                $query->where('order_date','=',$keydate);
            }
        })
        ->count();        

        $arr_count_page['order'] = ceil($count_model/$arr_perpage['order']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['order'],$arr_count_page['order']);

        return View::make('order._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keydate',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm() {
        $mode = 'add';
        $list_categorise = Categorise::lists('name','categorise_id');
        $list_location = ThaiHelper::getLocationList();
        $list_user = User::where('user_type','=',2)->lists('name','id');
        $list_agent = User::where('user_type','=',3)->lists('name','id');
        $list_product = Product::lists('name','id');
        $model = new Order();
        $model_item = new OrderItem();

        return View::make('order.form',compact('model','model_item','mode','list_product','list_categorise','list_agent','list_location','list_user'));
    }
    
    public function getFormEdit($order_id) {
        $mode = 'edit';
        $model = Order::find($order_id);
        $model_item = OrderItem::where('order_id','=',$order_id)->get();
        $model->order_date = ThaiHelper::DateToShowForm($model->order_date);
        $list_categorise = Categorise::lists('name','categorise_id');

        $list_location = ThaiHelper::getLocationList();
        $list_user = User::where('user_type','=',2)->lists('name','id');
        $list_agent = User::where('user_type','=',3)->lists('name','id');
        $list_product = Product::lists('name','id');


        return View::make('order.form',compact('model','model_item','mode','list_product','list_categorise','list_agent','list_location','list_user'));
    }
    public function postForm() {
        $validation = Order::validate(Input::all());
        $validation->setAttributeNames(Order::attributeName());
        if ($validation->passes()) {
            if(Input::get('order_id')){
                $model = Order::find(Input::get('order_id'));
                $model->order_title = Input::get('order_title');
                $model->order_date = ThaiHelper::DateToDB(Input::get('order_date'));
                $model->type = Input::get('type');
                $model->agent_id = Input::get('agent_id');
                $model->location_id = Input::get('location_id');
                $model->receive_by = Input::get('operate_by');
                $model->payment_by = Input::get('operate_by');
                $model->order_no = Input::get('order_no');
                if($model->save()){
                    return Redirect::action('OrderController@getIndex');
                }
            }else{             
                $model = new Order();
                $model->order_title = Input::get('order_title');
                $model->order_date = ThaiHelper::DateToDB(Input::get('order_date'));
                $model->type = Input::get('type');
                $model->agent_id = Input::get('agent_id');
                $model->location_id = Input::get('location_id');
                $model->receive_by = Input::get('operate_by');
                $model->payment_by = Input::get('operate_by');
                $model->order_no = Input::get('order_no');
                if($model->save()){
                    if(Input::get('product')){
                        foreach (Input::get('product') as $key => $value) {
                            $model_order_item = new OrderItem();
                            $model_order_item->order_id = $model->order_id;
                            $model_order_item->product_id = $value['product_id'];
                            $model_order_item->price = $value['price'];
                            $model_order_item->amount = $value['amount'];
                            $model_order_item->save();
                        }
                    }
                    return Redirect::action('OrderController@getIndex');
                }
            }
        }else{
            return Redirect::action('OrderController@getForm')
                            ->withErrors($validation)
                            ->withInput();    
        }
    }

    public function postFormItem() {
        $model = new OrderItem();
        $model->order_id = Input::get('order_id');
        $model->product_id = Input::get('product_id');
        $model->price = Input::get('price');
        $model->amount = Input::get('amount');
        $model->save();
        if($model->save()){
            return Response::json(array('status' => 'success'));
        }
    }

    public function postDeleteItem() {
        $id = Input::get('id');
        $model = OrderItem::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }

    public function postDelete() {
        $order_id = Input::get('order_id');
        $model= Order::find($order_id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }

    public function postView() {
        $order_id = Input::get('order_id');
        $model= OrderItem::where('order_id','=',$order_id)->get();
        
        return View::make('order._view',compact('model'));
    }

    public function postProductName() {
        $product_id = Input::get('product_id');
        $model= Product::find($product_id);
        if($model->count() > 0){
            return Response::json(array('status' => 'success','name'=>$model->name));
        }
    }
 
}
