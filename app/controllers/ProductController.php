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
            'product' => 10
        );
        $skip = ($arr_page['product'] - 1) * $arr_perpage['product'];

        $model = Product::skip($skip)->take($arr_perpage['product'])->get();

        $count_model = Product::count();                

        $arr_count_page['product'] = ceil($count_model/$arr_perpage['product']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['product'],$arr_count_page['product']);
        return View::make('product.index',compact(
                                        'model',
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

        $model = Product::skip($skip)->take($arr_perpage['product'])->get();

        $count_model = Product::count();                

        $arr_count_page['product'] = ceil($count_model/$arr_perpage['product']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['product'],$arr_count_page['product']);

        return View::make('product._tbl',compact(
                                        'model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm($product_id = NULL) {
    	$list_categories = Categorise::lists('name','categorise_id');
        $model = new Product();
        return View::make('product.form',compact(
            'list_categories',
            'model'
            ));
    }
    public function getFormEdit($id = NULL) {
        $list_categories = Categorise::lists('name','categorise_id');
        $model = Product::find($id);
        
        return View::make('product.form',compact(
            'list_categories',
            'model'
            ));
    }
    public function postForm() {
    	$validation = Product::validate(Input::all());
        $validation->setAttributeNames(Product::attributeName());
        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Product::find(Input::get('id'));
                $model->name = Input::get('name');
                $model->categorise_id = Input::get('categorise_id');
                $model->price = Input::get('price');
                $model->size = Input::get('size');
                $model->product_balance = Input::get('product_balance');
                $model->flavor = Input::get('flavor');
                if($model->save()){
                    return Redirect::action('ProductController@getIndex');                
                }
            }else{
                $model = new Product();
                $model->name = Input::get('name');
                $model->categorise_id = Input::get('categorise_id');
                $model->price = Input::get('price');
                $model->size = Input::get('size');
                $model->product_balance = Input::get('product_balance');
                $model->flavor = Input::get('flavor');
                if($model->save()){
                    return Redirect::action('ProductController@getIndex');                    
                }
            }
        }else{
            if(Input::get('id')){
        	return Redirect::action('ProductController@getFormEdit',Input::get('id'))
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
        $id = Input::get('id');
        $model = Product::find($id);
        if ($model->depositItem()->count() == 0 && $model->ordersItem()->count() == 0 && $model->productReturnItem()->count() == 0) {
            $model->delete();
            return Response::json(array('status' => 'success'));        
        } else {
            return Response::json(array('status' => 'fail'));        
        }
    }


 
}
