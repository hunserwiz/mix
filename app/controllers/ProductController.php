<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductController extends BaseController {

    public function getIndex() {
        $keyword = "";

        $arr_page = array(
            'product' => 1
        );

        $arr_perpage = array(
            'product' => 4
        );
        $skip = ($arr_page['product'] - 1) * $arr_perpage['product'];

        $model = Product::skip($skip)->take($arr_perpage['product'])
                            ->get();

        $count_model = Product::count();                

        $arr_count_page['product'] = ceil($count_model/$arr_perpage['product']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['product'],$arr_count_page['product']);
        return View::make('product.index',compact('model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');

        $arr_page = array(
            'product' => Input::get('page')
        );

        $arr_perpage = array(
            'product' => Input::get('perpage')
        );
        $skip = ($arr_page['product'] - 1) * $arr_perpage['product'];

         $model = Product::skip($skip)->take($arr_perpage['product'])
                            ->get();

        $count_model = Product::count();                

        $arr_count_page['product'] = ceil($count_model/$arr_perpage['product']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['product'],$arr_count_page['product']);

        return View::make('product._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm($product_id = NULL) {
    	$array_categories = Categorise::lists('name','categorise_id');
        $model = null;
        $model_stock = null;
        return View::make('product.form',compact(
            'array_categories',
            'model',
            'model_stock'
            ));
    }
    public function getFormEdit($product_id = NULL) {
        $array_categories = Categorise::lists('name','categorise_id');

        if($product_id != NULL || $_GET['product_id']){
            if($product_id == null)
                $product_id = $_GET['product_id'];
                $model = Product::find($product_id);
                $model_stock = Stock::where('product_id','=',$product_id)->first();
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
            if(Input::get('product_id')){
        	return Redirect::action('ProductController@getFormEdit',array('product_id'=>Input::get('product_id')))
                            ->withErrors($validation)
                            ->withInput();    
            }else{
            return Redirect::action('ProductController@getForm')
                        ->withErrors($validation)
                            ->withInput();    
            }
        }
    }
   
    public function postDelete() {
        $product_id = Input::get('product_id');
        $model_stock = Stock::where('product_id','=',$product_id)->first();
        if($model_stock->delete()){
            $model = Product::find($product_id);
            $model->delete();
            return Response::json(array('status' => 'success'));
        }
    }


 
}
