<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductReturnController extends BaseController {

    public function getIndex() {
        $keyword = "";

        $arr_page = array(
            'product' => 1
        );

        $arr_perpage = array(
            'product' => 10
        );
        $skip = ($arr_page['product'] - 1) * $arr_perpage['product'];

        $model = ProductReturn::skip($skip)->take($arr_perpage['product'])
                            ->get();

        $count_model = ProductReturn::count();                

        $arr_count_page['product'] = ceil($count_model/$arr_perpage['product']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['product'],$arr_count_page['product']);

        return View::make('productReturn.index',compact('model',
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

         $model = ProductReturn::skip($skip)->take($arr_perpage['product'])
                            ->get();

        $count_model = ProductReturn::count();                

        $arr_count_page['product'] = ceil($count_model/$arr_perpage['product']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['product'],$arr_count_page['product']);

        return View::make('productReturn._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm() {
        $model = null;
        $mode = "add";
    	$list_category = Categorise::lists('name','categorise_id');
        $list_location = ThaiHelper::getLocationList();
        $list_product = Product::lists('name','id');
        $list_user = User::where('user_type','=','2')->lists('name','id');
        $list_agent = User::where('user_type','=','3')->lists('name','id');

        return View::make('productReturn.form',compact(
            'model',
            'list_category',
            'list_product',
            'list_location',
            'list_user',
            'list_agent',
            'mode'
            ));
    }
    public function getFormEdit($id = NULL) {
        $model = ProductReturn::find($id);
        $mode = "edit";
        $list_category = Categorise::lists('name','categorise_id');
        $list_location = ThaiHelper::getLocationList();
        $list_product = Product::where('categorise_id','=',$model->categorise_id)->lists('name','id');
        $list_user = User::where('user_type','=','2')->lists('name','id');
        $list_agent = User::where('user_type','=','3')->lists('name','id');
        $model->date_return = ThaiHelper::DateToShowForm($model->date_return);
        $model->product_date = ThaiHelper::DateToShowForm($model->product_date);
        $model->expired_date = ThaiHelper::DateToShowForm($model->expired_date);


        return View::make('productReturn.form',compact(
            'model',
            'list_category',
            'list_product',
            'list_location',
            'list_user',
            'list_agent',
            'mode'
            ));
    }
    public function postForm() {
    	$validation = ProductReturn::validate(Input::all());
        $validation->setAttributeNames(ProductReturn::attributeName());
        if ($validation->passes()) {
            if(Input::get('id')){
                $model = ProductReturn::find(Input::get('id'));
                $model->date_return = ThaiHelper::DateToDB(Input::get('date_return'));
                $model->product_id = Input::get('product_id');
                $model->categorise_id = Input::get('categorise_id');
                $model->price = Input::get('price');
                $model->amount = Input::get('amount');
                $model->location_id = Input::get('location_id');
                $model->return_by = Input::get('return_by');
                $model->create_by = Input::get('create_by');
                $model->product_date = ThaiHelper::DateToDB(Input::get('product_date'));
                $model->expired_date = ThaiHelper::DateToDB(Input::get('expired_date'));
                if($model->save()){
                    return Redirect::action('ProductReturnController@getIndex');
                }
            }else{
                $model = new ProductReturn();
                $model->date_return = ThaiHelper::DateToDB(Input::get('date_return'));
                $model->product_id = Input::get('product_id');
                $model->categorise_id = Input::get('categorise_id');
                $model->price = Input::get('price');
                $model->amount = Input::get('amount');
                $model->location_id = Input::get('location_id');
                $model->return_by = Input::get('return_by');
                $model->create_by = Input::get('create_by');
                $model->product_date = ThaiHelper::DateToDB(Input::get('product_date'));
                $model->expired_date = ThaiHelper::DateToDB(Input::get('expired_date'));
                if($model->save()){
                    return Redirect::action('ProductReturnController@getIndex');
                }
            }
        }else{
            if(Input::get('id')){
            	return Redirect::action('ProductReturnController@getFormEdit',Input::get('id'))
                                ->withErrors($validation)
                                ->withInput();    
            }else{
                return Redirect::action('ProductReturnController@getForm')
                                ->withErrors($validation)
                                ->withInput();    
            }
        }
    }
   
    public function postDelete() {
        $id = Input::get('id');
        $model = ProductReturn::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }

    public function getListProduct() {
        $categorise_id = Input::get('categorise_id');
        $list_product = Product::where('categorise_id','=',$categorise_id)->lists('name','id');
        
        return View::make('productReturn._list_product',compact('list_product'));
    }


 
}
