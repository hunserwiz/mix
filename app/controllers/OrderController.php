<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderController extends BaseController {

    public function getIndex() {
    	$model = Order::all();
        return View::make('order.index',compact('model'));
    }
    public function getForm() {
        $list_categorise = Categorise::lists('name','categorise_id');
        $model_agent = Agent::get();
        $list_agent = array();
        $list_location = ThaiHelper::getLocationList();
        $list_user = User::where('user_type','=',2)->lists('name','id');


        if($model_agent->count() > 0)
        foreach ($model_agent as $key => $value) {
            $list_agent[$value->agent_id] = $value->agent_name." ".$value->agent_lastname;
        }

        return View::make('order.form',compact('list_categorise','list_agent','list_location','list_user'));
    }
     public function getFormEdit() {
        return View::make('order.form');
    }
    public function postForm() {
        $validation = Order::validate(Input::all());
        $validation->setAttributeNames(Order::attributeName());
        if ($validation->passes()) {
            if(Input::get('order_id')){
                $model = Order::find(Input::get('product_id'));
                $model->name = Input::get('name');
                $model->categorise_id = Input::get('categorise_id');
                $model->price = Input::get('price');
                $model->size = Input::get('size');
                $model->flavor = Input::get('flavor');
                if($model->save()){
                    $model_stock = Stock::where('product_id','=',Input::get('product_id'))->first();
                    $model_stock->product_balance = Input::get('product_balance');
                    if($model_stock->save()){
                        return Redirect::action('ProductController@getIndex');
                    }
                }
            }else{
                $model = new Order();
                $model->oder_date = Input::get('oder_date');
                $model->product_id = Input::get('product_id');
                $model->price = Input::get('price');
                $model->amount = Input::get('amount');
                $model->agent_id = Input::get('agent_id');
                $model->location_id = Input::get('location_id');
                $model->operate_by = Input::get('operate_by');
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
    
 
}
