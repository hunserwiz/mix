<?php

class FinanceController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex() {
        $keyword = "";
        $keydate = "";
        $keytype = "";

        $arr_page = array(
            'finance' => 1
        );

        $arr_perpage = array(
            'finance' => 10
        );
        $skip = ($arr_page['finance'] - 1) * $arr_perpage['finance'];

        $model = Finance::where(function($query) use ($keyword,$keydate,$keytype)
        {
           if($keyword){
                $query->where('detail','LIKE',"%".$keyword."%");
            }
            if($keydate){
                $query->where('date_account','=',$keydate);
            }
            if($keytype){
                $query->where('type','=',$keytype);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['finance'])->get();

        $count_model = Finance::where(function($query) use ($keyword,$keydate,$keytype)
        {
            if($keyword){
                $query->where('detail','LIKE',"%".$keyword."%");
            }
            if($keydate){
                $query->where('date_account','=',$keydate);
            }
            if($keytype){
                $query->where('type','=',$keytype);
            }
        })
        ->count();               

        $arr_count_page['finance'] = ceil($count_model/$arr_perpage['finance']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['finance'],$arr_count_page['finance']);
        
        return View::make('finance.index',compact('model',
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
            'finance' => Input::get('page')
        );

        $arr_perpage = array(
            'finance' => Input::get('perpage')
        );
        $skip = ($arr_page['finance'] - 1) * $arr_perpage['finance'];

        $model = Finance::where(function($query) use ($keyword,$keydate,$keytype)
        {
           if($keyword){
                $query->where('detail','LIKE',"%".$keyword."%");
            }
            if($keydate){
                $query->where('date_account','=',$keydate);
            }
            if($keytype){
                $query->where('type','=',$keytype);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['finance'])->get();

        $count_model = Finance::where(function($query) use ($keyword,$keydate,$keytype)
        {
            if($keyword){
                $query->where('detail','LIKE',"%".$keyword."%");
            }
            if($keydate){
                $query->where('date_account','=',$keydate);
            }
            if($keytype){
                $query->where('type','=',$keytype);
            }
        })
        ->count();                
        $arr_count_page['finance'] = ceil($count_model/$arr_perpage['finance']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['finance'],$arr_count_page['finance']);

        return View::make('finance._tbl',compact('model',
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
        $list_user = User::where('user_type','=',2)->lists('name','id');  
        $list_type = ThaiHelper::getTypeAccountList();

        return View::make('finance.form',compact('model','list_user','list_type'));
    }

    public function getFormEdit($id) {
        $list_user = User::where('user_type','=',2)->lists('name','id');  
        $list_type = ThaiHelper::getTypeAccountList();
        $model = Finance::find($id);
        $model->date_account = ThaiHelper::DateToShowForm($model->date_account);

        return View::make('finance.form',compact('model','list_user','list_type'));
    }

    public function postForm() {
        $validation = Finance::validate(Input::all());
        $validation->setAttributeNames(Finance::attributeName());
        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Finance::find(Input::get('id'));
                $model->date_account = ThaiHelper::DateToDB(Input::get('date_account'));
                $model->type = Input::get('type');
                $model->price = Input::get('price');
                $model->detail = Input::get('detail');
                $model->create_by = Input::get('create_by');
                if($model->save()){
                        return Redirect::action('FinanceController@getIndex');
                }
            }else{
                $model = new Finance();
                $model->date_account = ThaiHelper::DateToDB(Input::get('date_account'));
                $model->type = Input::get('type');
                $model->price = Input::get('price');
                $model->detail = Input::get('detail');
                $model->create_by = Input::get('create_by');
                if($model->save()){
                    return Redirect::action('FinanceController@getIndex');
                }
            }
        }else{
            if(Input::get('id')){
                return Redirect::action('FinanceController@getFormEdit',Input::get('id'))
                            ->withErrors($validation)
                            ->withInput();    
            }else{
                return Redirect::action('FinanceController@getForm')
                            ->withErrors($validation)
                            ->withInput();  
            }
        }
    }

    public function postDelete() {
        $id = Input::get('id');
        $model= Finance::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }
}
