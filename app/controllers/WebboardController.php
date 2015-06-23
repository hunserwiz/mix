<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WebboardController extends BaseController {

    public function getIndex() {
        $keyword = "";
        $keytype = "";

        $arr_page = array(
            'webboard' => 1
        );

        $arr_perpage = array(
            'webboard' => 10
        );
        $skip = ($arr_page['webboard'] - 1) * $arr_perpage['webboard'];

        $model = Webboard::orderBy('created_at', 'desc')->skip($skip)->take($arr_perpage['webboard'])->get();

        $count_model = Webboard::count();                

        $arr_count_page['webboard'] = ceil($count_model/$arr_perpage['webboard']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['webboard'],$arr_count_page['webboard']);

        return View::make('webboard.index',compact(
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

    public function getComment($id) {
        $model = Webboard::find($id);

        return View::make('webboard.form_comment',compact(
                                        'model',
                                        ));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');
        $keydate = ThaiHelper::DateToDB(Input::get('keydate'));

        $arr_page = array(
            'webboard' => Input::get('page')
        );

        $arr_perpage = array(
            'webboard' => Input::get('perpage')
        );
        $skip = ($arr_page['webboard'] - 1) * $arr_perpage['webboard'];

        $model = Webboard::where(function($query) use ($keyword)
        {
           if($keyword){
                $query->where('topic','LIKE',"%".$keyword."%");
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['webboard'])->get();

        $count_model = Webboard::where(function($query) use ($keyword)
        {
            if($keyword){
                $query->where('topic','LIKE',"%".$keyword."%");
            }
        })
        ->count();        

        $arr_count_page['webboard'] = ceil($count_model/$arr_perpage['webboard']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['webboard'],$arr_count_page['webboard']);

        return View::make('webboard._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
            ));
    }

    public function getForm() {
        $model = new Webboard();

        return View::make('webboard.form',compact('model'));
    }

    public function getFormEdit($id) {
        $model = Webboard::find($id);

        return View::make('webboard.form',compact('model'));
    }

    public function postForm(){
        $validation = Webboard::validate(Input::all());
        $validation->setAttributeNames(Webboard::attributeName());

        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Webboard::find(Input::get('id'));
                $model->topic = Input::get('topic');
                if($model->save()){
                    return Redirect::action('WebboardController@getIndex');
                }
            }else{
                $model = new Webboard();
                $model->topic = Input::get('topic');
                $model->create_by = Auth::user()->id;
                if($model->save()){
                    return Redirect::action('WebboardController@getIndex');
                }
            }
        } else {
            if (Input::get('id')) {
                return Redirect::action('WebboardController@getFormEdit',Input::get('id'))
                            ->withErrors($validation)
                            ->withInput();
            } else {
                return Redirect::action('WebboardController@getForm')
                            ->withErrors($validation)
                            ->withInput();
            }
        }
    }

    public function postFormComment(){
        $validation = WebboardComment::validate(Input::all());
        $validation->setAttributeNames(WebboardComment::attributeName());

        if ($validation->passes()) {
            $model = new WebboardComment();
            $model->comment = Input::get('comment');
            $model->webboard_id = Input::get('webboard_id');
            $model->create_by = Auth::user()->id;
            if($model->save()){
                return Redirect::action('WebboardController@getComment'Input::get('webboard_id'));
            }
        } else {
                return Redirect::action('WebboardController@getFormComment',Input::get('webboard_id'))
                            ->withErrors($validation)
                            ->withInput();
        }
    }

    public function postDelete() {
        $id = Input::get('id');
        $model= Webboard::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }



   
}
