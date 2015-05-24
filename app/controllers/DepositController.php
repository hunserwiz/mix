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
        $keydeposit = "";

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
        $list_agent = User::where('user_type','=','3')->lists('name','id');            

        $arr_count_page['deposit'] = ceil($count_model/$arr_perpage['deposit']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['deposit'],$arr_count_page['deposit']);

        return View::make('deposit.index',compact('model',
                                        'count_model',
                                        'list_agent',
                                        'keyword',
                                        'keydate',
                                        'keydeposit',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'));
    }

    public function postIndexItem() {
        $model = Deposit::find(Input::get('deposit_id'));
        $model_deposit_item = DepositItem::where("deposit_id","=",Input::get('deposit_id'))->get();
        $mode = Input::get('mode');
        return View::make('deposit._tbl_item',compact('model','model_deposit_item','mode'));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');
        $keydate = Input::get('keydate');
        $keydeposit = Input::get('keydeposit');
        $keydate = ThaiHelper::DateToDB($keydate);

        $arr_page = array(
            'deposit' => Input::get('page')
        );

        $arr_perpage = array(
            'deposit' => Input::get('perpage')
        );
        $skip = ($arr_page['deposit'] - 1) * $arr_perpage['deposit'];

        $model = Deposit::where(function($query) use ($keyword,$keydate,$keydeposit)
        {
            if($keydate){
                $query->where('date_deposit','=',$keydate);
            }
            if($keydeposit){
                $query->where('deposit_by','=',$keydeposit);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['deposit'])->get();

        $count_model = Deposit::where(function($query) use ($keyword,$keydate,$keydeposit)
        {
            if($keydate){
                $query->where('date_deposit','=',$keydate);
            }
            if($keydeposit){
                $query->where('deposit_by','=',$keydeposit);
            }
        })
        ->count();           
        $list_agent = User::where('user_type','=','3')->lists('name','id');   

        $arr_count_page['deposit'] = ceil($count_model/$arr_perpage['deposit']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['deposit'],$arr_count_page['deposit']);

        return View::make('deposit._tbl',compact('model',
                                        'count_model',
                                        'list_agent',
                                        'keyword',
                                        'keydate',
                                        'keydeposit',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm() {
        $model = new Deposit();
        $model_deposit_item = new DepositItem();
        $model_product = Product::all();
        $list_location = ThaiHelper::getLocationList();
        $mode = "add";
        $list_product = Product::lists('name','id');
        $list_user = User::where('user_type','=','2')->lists('name','id');
        $list_agent = User::where('user_type','=','3')->lists('name','id');
        
        return View::make('deposit.form',compact(
            'model',
            'model_deposit_item',
            'list_category',
            'list_product',
            'list_location',
            'list_user',
            'list_agent',
            'mode',
            'model_product',
            'list_location'
            ));
    }
    public function getFormEdit($id = NULL) {
        $model = Deposit::find($id);
        $model_deposit_item = DepositItem::where('deposit_id','=',$id)->get();
        $model_product = Product::all();
        $list_location = ThaiHelper::getLocationList();
        $mode = "edit";
        $list_product = Product::lists('name','id');
        $list_user = User::where('user_type','=','2')->lists('name','id');
        $list_agent = User::where('user_type','=','3')->lists('name','id');
        $model->date_deposit = ThaiHelper::DateToShowForm($model->date_deposit);
        $model->date_deposit_return = ThaiHelper::DateToShowForm($model->date_deposit_return);
        $arr_data = array();
        
        if($model_deposit_item->count() > 0){
            
            foreach ($model_deposit_item as $key => $value) {
                $arr_data[$value->product_id]['home'] = $value->at_home;
                $arr_data[$value->product_id]['box'] = $value->at_box;
                $arr_data[$value->product_id]['market'] = $value->at_market;
            }
        }

        return View::make('deposit.form',compact(
            'model',
            'model_deposit_item',
            'list_category',
            'list_product',
            'list_location',
            'list_user',
            'list_agent',
            'mode',
            'model_product',
            'arr_data',
            'list_location'
            ));
    }
    public function postForm() {
        $validation = Deposit::validate(Input::all());
        $validation->setAttributeNames(Deposit::attributeName());

        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Deposit::find(Input::get('id'));
                $model->date_deposit = ThaiHelper::DateToDB(Input::get('date_deposit'));
                $model->date_deposit_return = ThaiHelper::DateToDB(Input::get('date_deposit_return'));
                $model->location_id = Input::get('location_id');
                $model->total_home = Input::get('home');
                $model->total_box = Input::get('box');
                $model->total_market = Input::get('market');                          
                $model->deposit_by = Input::get('deposit_by');
                $model->create_by = Input::get('create_by');
                if($model->save()){
                    if(Input::get('product')){

                        foreach (Input::get('product') as $product_id => $value) {
                            $model_deposit_item = DepositItem::where('deposit_id','=',Input::get('id'))
                                                               ->where('product_id','=', $product_id)
                                                               ->first();
                            if ($model_deposit_item->count() > 0) {
                                $model_deposit_item->at_home    = $value['home'];
                                $model_deposit_item->at_box     = $value['box'];
                                $model_deposit_item->at_market  = $value['market'];
                                $model_deposit_item->save();
                            }
                        }
                    }
                    return Redirect::action('DepositController@getIndex');
                }
            }else{
                $model = new Deposit();
                $model->date_deposit = ThaiHelper::DateToDB(Input::get('date_deposit'));
                $model->date_deposit_return = ThaiHelper::DateToDB(Input::get('date_deposit_return'));
                $model->location_id = Input::get('location_id');
                $model->total_home = Input::get('home');
                $model->total_box = Input::get('box');
                $model->total_market = Input::get('market');          
                $model->deposit_by = Input::get('deposit_by');
                $model->create_by = Input::get('create_by');
                if($model->save()){
                    if(Input::get('product')){
                        foreach (Input::get('product') as $key => $value) {
                            $model_deposit_item = new DepositItem();
                            $model_deposit_item->deposit_id = $model->id;
                            $model_deposit_item->product_id = $key;
                            $model_deposit_item->at_home    = $value['home'];
                            $model_deposit_item->at_box     = $value['box'];
                            $model_deposit_item->at_market  = $value['market'];
                            $model_deposit_item->save();
                        }
                    }
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

    public function postFormItem() {
        $model = new DepositItem();
        $model->deposit_id = Input::get('deposit_id');
        $model->product_id = Input::get('product_id');
        $model->price = Input::get('price');
        $model->amount = Input::get('amount');
        $model->save();
        if($model->save()){
            return Response::json(array('status' => 'success'));
        }
    }
    
    public function postView() {
        $deposit_id = Input::get('deposit_id');
        $model = Deposit::find($deposit_id);
        $model_item = DepositItem::where('deposit_id','=',$deposit_id)->get();
        $model_product = Product::all();
        return View::make('deposit._view',compact('model','model_item','model_product'));
    }
    
    public function postDelete() {
        $id = Input::get('id');
        $model = Deposit::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    } 

    public function postDeleteItem() {
        $id = Input::get('id');
        $model = DepositItem::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }
}
