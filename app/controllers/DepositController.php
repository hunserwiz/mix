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

    public function postIndexItem() {
        $model = Deposit::find(Input::get('deposit_id'));
        $model_deposit_item = DepositItem::where("deposit_id","=",Input::get('deposit_id'))->get();
        $mode = Input::get('mode');
        return View::make('deposit._tbl_item',compact('model','model_deposit_item','mode'));
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
        $model = new Deposit();
        $model_deposit_item = new DepositItem();
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
            'mode'
            ));
    }
    public function getFormEdit($id = NULL) {
        $model = Deposit::find($id);
        $model_deposit_item = DepositItem::where('deposit_id','=',$id)->get();
        $mode = "edit";
        $list_product = Product::lists('name','id');
        $list_user = User::where('user_type','=','2')->lists('name','id');
        $list_agent = User::where('user_type','=','3')->lists('name','id');
        $model->date_deposit = ThaiHelper::DateToShowForm($model->date_deposit);
        $model->date_deposit_return = ThaiHelper::DateToShowForm($model->date_deposit_return);

        return View::make('deposit.form',compact(
            'model',
            'model_deposit_item',
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
        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Deposit::find(Input::get('id'));
                $model->date_deposit = ThaiHelper::DateToDB(Input::get('date_deposit'));
                $model->type_deposit_id = Input::get('type_deposit_id');                            
                $model->deposit_by = Input::get('deposit_by');
                $model->create_by = Input::get('create_by');
                $model->date_deposit_return = ThaiHelper::DateToDB(Input::get('date_deposit_return'));
                if($model->save()){
                    return Redirect::action('DepositController@getIndex');
                }
            }else{
                $model = new Deposit();
                $model->date_deposit = ThaiHelper::DateToDB(Input::get('date_deposit'));
                $model->type_deposit_id = Input::get('type_deposit_id');                            
                $model->deposit_by = Input::get('deposit_by');
                $model->create_by = Input::get('create_by');
                $model->date_deposit_return = ThaiHelper::DateToDB(Input::get('date_deposit_return'));
                if($model->save()){
                    if(Input::get('product')){
                        foreach (Input::get('product') as $key => $value) {
                            $model_deposit_item = new DepositItem();
                            $model_deposit_item->deposit_id = $model->id;
                            $model_deposit_item->product_id = $value['product_id'];
                            $model_deposit_item->price = $value['price'];
                            $model_deposit_item->amount = $value['amount'];
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
        $model = DepositItem::where('deposit_id','=',$deposit_id)->get();
        return View::make('deposit._view',compact('model'));
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
