<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DepositController extends BaseController {

    public function getIndex() {
        $keyword = "";
        $keydate = "";
        $keytype = "";

        $arr_page = array(
            'deposit' => 1
        );

        $arr_perpage = array(
            'deposit' => 10
        );
        $skip = ($arr_page['deposit'] - 1) * $arr_perpage['deposit'];

        $model = Deposit::orderBy('created_at', 'desc')
                        ->skip($skip)->take($arr_perpage['deposit'])
                        ->get();

        $count_model = Deposit::count();                

        $arr_count_page['deposit'] = ceil($count_model/$arr_perpage['deposit']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['deposit'],$arr_count_page['deposit']);

        return View::make('deposit.index',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keydate',
                                        'keytype',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');
        $keydate = Input::get('keydate');
        $keytype = Input::get('keytype');
        $keydate = ThaiHelper::DateToDB($keydate);

        $arr_page = array(
            'deposit' => Input::get('page')
        );

        $arr_perpage = array(
            'deposit' => Input::get('perpage')
        );
        $skip = ($arr_page['deposit'] - 1) * $arr_perpage['deposit'];

        $model = Deposit::where(function($query) use ($keyword,$keydate,$keytype)
        {
           // if($keyword){
           //      $query->where('detail','LIKE',"%".$keyword."%");
           //  }
            if($keydate){
                $query->where('date_deposit','=',$keydate);
            }
            if($keytype){
                $query->where('type_deposit_id','=',$keytype);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['deposit'])->get();

        $count_model = Deposit::where(function($query) use ($keyword,$keydate,$keytype)
        {
            // if($keyword){
            //     $query->where('detail','LIKE',"%".$keyword."%");
            // }
            if($keydate){
                $query->where('date_deposit','=',$keydate);
            }
            if($keytype){
                $query->where('type_deposit_id','=',$keytype);
            }
        })
        ->count();           

        $arr_count_page['deposit'] = ceil($count_model/$arr_perpage['deposit']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['deposit'],$arr_count_page['deposit']);

        return View::make('deposit._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keydate',
                                        'keytype',
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
        
        return View::make('deposit.form',compact(
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
        $model = Deposit::find($id);
        $mode = "edit";
        $list_category = Categorise::lists('name','categorise_id');
        $list_location = ThaiHelper::getLocationList();
        $list_product = Product::where('categorise_id','=',$model->categorise_id)->lists('name','id');
        $list_user = User::where('user_type','=','2')->lists('name','id');
        $list_agent = User::where('user_type','=','3')->lists('name','id');
        $model->date_deposit = ThaiHelper::DateToShowForm($model->date_deposit);
        $model->date_return_depoist = ThaiHelper::DateToShowForm($model->date_return_depoist);

        return View::make('deposit.form',compact(
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
        $validation = Deposit::validate(Input::all());
        $validation->setAttributeNames(Deposit::attributeName());
        echo "<pre>";
        print_r(Input::all());
        echo "</pre>";
        die;
        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Deposit::find(Input::get('id'));
                $model->date_deposit = ThaiHelper::DateToDB(Input::get('date_deposit'));
                $model->categorise_id = Input::get('categorise_id');
                $model->product_id = Input::get('product_id');    
                $model->type_deposit_id = Input::get('type_deposit_id');                            
                $model->amount = Input::get('amount');
                $model->deposit_by = Input::get('deposit_by');
                $model->create_by = Input::get('create_by');
                $model->date_return_depoist = ThaiHelper::DateToDB(Input::get('date_return_depoist'));
                if($model->save()){
                    return Redirect::action('DepositController@getIndex');
                }
            }else{
                $model = new Deposit();
                $model->date_deposit = ThaiHelper::DateToDB(Input::get('date_deposit'));
                $model->categorise_id = Input::get('categorise_id');
                $model->product_id = Input::get('product_id');    
                $model->type_deposit_id = Input::get('type_deposit_id');                            
                $model->amount = Input::get('amount');
                $model->deposit_by = Input::get('deposit_by');
                $model->create_by = Input::get('create_by');
                $model->date_return_depoist = ThaiHelper::DateToDB(Input::get('date_return_depoist'));
                if($model->save()){
                    return Redirect::action('DepositController@getIndex');
                }
            }
        }else{
            if(Input::get('id')){
                return Redirect::action('DepositController@getFormEdit',Input::get('id'))
                                ->withErrors($validation)
                                ->withInput();    
            }else{
                return Redirect::action('DepositController@getForm')
                                ->withErrors($validation)
                                ->withInput();    
            }
        }
    }
   
    public function postDelete() {
        $id = Input::get('id');
        $model = Deposit::find($id);
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
