<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderController extends BaseController {

    public function getIndex() {
    	$keyword = "";

        $arr_page = array(
            'order' => 1
        );

        $arr_perpage = array(
            'order' => 10
        );
        $skip = ($arr_page['order'] - 1) * $arr_perpage['order'];

        $model = Order::skip($skip)->take($arr_perpage['order'])
                            ->get();

        $count_model = Order::count();                

        $arr_count_page['order'] = ceil($count_model/$arr_perpage['order']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['order'],$arr_count_page['order']);

        return View::make('order.index',compact('model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
                                        ));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');

        $arr_page = array(
            'order' => Input::get('page')
        );

        $arr_perpage = array(
            'order' => Input::get('perpage')
        );
        $skip = ($arr_page['order'] - 1) * $arr_perpage['order'];

        $model = Order::skip($skip)->take($arr_perpage['order'])
                            ->get();

        $count_model = Order::count();                

        $arr_count_page['order'] = ceil($count_model/$arr_perpage['order']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['order'],$arr_count_page['order']);

        return View::make('order._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm() {
        $list_categorise = Categorise::lists('name','categorise_id');
        $model_agent = Agent::get();
        $list_agent = array();
        $list_location = ThaiHelper::getLocationList();
        $list_user = User::where('user_type','=',2)->lists('name','id');
        $list_product = Product::lists('name','product_id');
        $model = null;
        if($model_agent->count() > 0)
        foreach ($model_agent as $key => $value) {
            $list_agent[$value->agent_id] = $value->agent_name." ".$value->agent_lastname;
        }

        return View::make('order.form',compact('model','list_product','list_categorise','list_agent','list_location','list_user'));
    }
    
    public function getFormEdit($order_id) {
        $model = Order::find($order_id);
        $model->order_date = ThaiHelper::DateToShowForm($model->order_date);
        $list_categorise = Categorise::lists('name','categorise_id');
        $model_agent = Agent::get();
        $list_agent = array();
        $list_location = ThaiHelper::getLocationList();
        $list_user = User::where('user_type','=',2)->lists('name','id');
        $list_product = Product::lists('name','product_id');

        if($model_agent->count() > 0)
        foreach ($model_agent as $key => $value) {
            $list_agent[$value->agent_id] = $value->agent_name." ".$value->agent_lastname;
        }
        return View::make('order.form',compact('model','list_product','list_categorise','list_agent','list_location','list_user'));
    }
    public function postForm() {
        $validation = Order::validate(Input::all());
        $validation->setAttributeNames(Order::attributeName());
        if ($validation->passes()) {
            if(Input::get('order_id')){
                $model = Order::find(Input::get('order_id'));
                $model->order_title = Input::get('order_title');
                $model->order_date = ThaiHelper::DateToDB(Input::get('order_date'));
                $model->category_id = Input::get('category');
                $model->product_id = Input::get('product_id');
                $model->price = Input::get('price');
                $model->amount_total = Input::get('amount');
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
                $model->category_id = Input::get('category');
                $model->product_id = Input::get('product_id');
                $model->price = Input::get('price');
                $model->amount_total = Input::get('amount');
                $model->agent_id = Input::get('agent_id');
                $model->location_id = Input::get('location_id');
                $model->receive_by = Input::get('operate_by');
                $model->payment_by = Input::get('operate_by');
                $model->order_no = Input::get('order_no');
                if($model->save()){
                    return Redirect::action('OrderController@getIndex');
                }
            }
        }else{
            return Redirect::action('OrderController@getForm')
                            ->withErrors($validation)
                            ->withInput();    
        }
    }

    public function postDelete() {
        $order_id = Input::get('order_id');
        $model= Order::find($order_id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }
 
}
