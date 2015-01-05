<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductController extends BaseController {

    public function getIndex() {
    	$model = Product::all();
        return View::make('product.index',compact('model'));
    }

    public function getForm($product_id=null) {
    	$array_categories = Categorise::lists('name','categorise_id');
        if($product_id != null || $_GET['product_id']){
            if($product_id == null)
                $product_id = $_GET['product_id'];
                $model = Product::find($product_id);
                $model_stock = Stock::where('product_id','=',$product_id)->first();
        }else{
            $model = null;
            $model_stock = null;
        }
        return View::make('product.form',compact(
            'array_categories',
            'model',
            'model_stock'
            ));
    }

    public function postForm() {
    	$validation = Product::validate(Input::all());
        $validation->setAttributeNames(Product::attributeName());
        if ($validation->passes()) {
            if(Input::get('product_id')){
                $model = Product::find(Input::get('product_id'));
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
                $model = new Product();
                $model->name = Input::get('name');
                $model->categorise_id = Input::get('categorise_id');
                $model->price = Input::get('price');
                $model->size = Input::get('size');
                $model->flavor = Input::get('flavor');
                if($model->save()){
                    $model_stock = new Stock();
                    $model_stock->product_id = $model->product_id;
                    $model_stock->product_balance = Input::get('product_balance');
                    if($model_stock->save()){
                        return Redirect::action('ProductController@getIndex');
                    }
                }
            }
        }else{
        	return Redirect::action('ProductController@getForm',array('product_id'=>Input::get('product_id')))
                            ->withErrors($validation)
                            ->withInput();    
        }
    }
    
    public function getDelete($product_id = null) {
        $model_stock = Stock::where('product_id','=',$product_id)->first();
        if($model_stock->delete()){
            $model = Product::find($product_id);
            $model->delete();
        }
        return Redirect::action('ProductController@getIndex');
    }


 
}
