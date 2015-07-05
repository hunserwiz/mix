<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends BaseController {

    public function getIndex() {
        $keyword = "";
        $keytype = "";

        $arr_page = array(
            'user' => 1
        );

        $arr_perpage = array(
            'user' => 10
        );
        $skip = ($arr_page['user'] - 1) * $arr_perpage['user'];

        $model = User::orderBy('created_at', 'desc')->skip($skip)->take($arr_perpage['user'])->get();
        
        $count_model = User::count();                

        $arr_count_page['user'] = ceil($count_model/$arr_perpage['user']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['user'],$arr_count_page['user']);

        // $this->alert($arr_page['user']);
        // $this->alert($arr_count_page['user']);
        // $this->alert($arr_list_page);
        return View::make('account.index',compact(
                                        'model',
                                        'count_model',
                                        'keyword',
                                        'keytype',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
                                        ));
    }

      public function postSearch() {
        $keyword = Input::get('keyword');
        $keytype = Input::get('keytype');

        $arr_page = array(
            'user' => Input::get('page')
        );

        $arr_perpage = array(
            'user' => Input::get('perpage')
        );
        $skip = ($arr_page['user'] - 1) * $arr_perpage['user'];

        $model = User::where(function($query) use ($keyword,$keytype)
        {
           if($keyword){
                $query->where('name','LIKE',"%".$keyword."%")
                ->orWhere('first_name','LIKE',"%".$keyword."%");
            }
            if($keytype){
                $query->where('user_type','=',$keytype);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['user'])->get();

        $count_model = User::where(function($query) use ($keyword,$keytype)
        {
            if($keyword){
                $query->where('name','LIKE',"%".$keyword."%")
                ->orWhere('first_name','LIKE',"%".$keyword."%");
            }
            if($keytype){
                $query->where('user_type','=',$keytype);
            }
        })
        ->count();        

        $arr_count_page['user'] = ceil($count_model/$arr_perpage['user']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['user'],$arr_count_page['user']);

        return View::make('account._tbl_user',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keytype',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm() {
        $model = new User();

        return View::make('account.form',compact('model'));
    }

    public function getFormEdit($id) {
        $model = User::find($id);

        return View::make('account.form',compact('model'));
    }

    public function postForm(){
        $validation = User::validate(Input::all());
        $validation->setAttributeNames(User::attributeName());

        if ($validation->passes()) {
            if(Input::get('id')){
                $model = User::find(Input::get('id'));
                $model->first_name = Input::get('first_name');
                $model->last_name = Input::get('last_name');
                $model->email = Input::get('email');
                $model->username = Input::get('username');
                $model->password = Hash::make(Input::get('password'));
                $model->user_type = Input::get('user_type');
                if($model->save()){
                    return Redirect::action('UserController@getIndex');
                }
            }else{
                $model = new User();
                $model->first_name = Input::get('first_name');
                $model->last_name = Input::get('last_name');
                $model->name = $model->first_name;
                $model->email = Input::get('email');
                $model->username = Input::get('username');
                $model->password = Hash::make(Input::get('password'));
                $model->user_type = Input::get('user_type');
                $model->is_active = 1;
                if($model->save()){
                    return Redirect::action('UserController@getIndex');
                }
            }
        } else {
            // echo "<pre>";
            // print_r($validation->errors());
            // echo "</pre>";
            // die('11');
            if (Input::get('id')) {
                return Redirect::action('UserController@getFormEdit',Input::get('id'))
                            ->withErrors($validation)
                            ->withInput();
            } else {
                return Redirect::action('UserController@getForm')
                            ->withErrors($validation)
                            ->withInput();
            }
        }
    }

    public function postDelete() {
        $id = Input::get('id');
        $model= User::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }



   
}
