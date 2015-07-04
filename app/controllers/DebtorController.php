<?php

class DebtorController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function getIndex() {
        $keyword = "";
        $keydate = "";

        $arr_page = array(
            'debtor' => 1
        );

        $arr_perpage = array(
            'debtor' => 10
        );
        $skip = ($arr_page['debtor'] - 1) * $arr_perpage['debtor'];

        $model = Debtor::skip($skip)->take($arr_perpage['debtor'])
                            ->get();

        $count_model = Debtor::count();                

        $arr_count_page['debtor'] = ceil($count_model/$arr_perpage['debtor']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['debtor'],$arr_count_page['debtor']);
        $list_debtor = User::where('user_type','=',3)->lists('name','id'); 

        return View::make('debtor.index',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keydate',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page','list_debtor'));
    }

    public function postSearch() {
        $keyword = Input::get('keyword');
        $keydate = Input::get('keydate');
        $keydate = ThaiHelper::DateToDB($keydate);

        $arr_page = array(
            'debtor' => Input::get('page')
        );

        $arr_perpage = array(
            'debtor' => Input::get('perpage')
        );
        $skip = ($arr_page['debtor'] - 1) * $arr_perpage['debtor'];
             
        $model = Debtor::where(function($query) use ($keyword,$keydate)
        {
            if($keyword){
                $query->where('debtor_id','=',$keyword);
            }
            if($keydate){
                $query->where('date_pay','=',$keydate);
            }
        })
        ->orderBy('created_at', 'desc')
        ->skip($skip)->take($arr_perpage['debtor'])->get();

        $count_model = Debtor::where(function($query) use ($keyword,$keydate)
        {
            if($keyword){
                $query->where('debtor_id','=',$keyword);
            }
            if($keydate){
                $query->where('date_pay','=',$keydate);
            }
        })
        ->count();  

        $arr_count_page['debtor'] = ceil($count_model/$arr_perpage['debtor']); 
        $arr_list_page = ThaiHelper::getArrListPage($arr_page['debtor'],$arr_count_page['debtor']);
        $list_debtor = User::where('user_type','=',3)->lists('name','id'); 

        return View::make('debtor._tbl',compact('model',
                                        'count_model',
                                        'keyword',
                                        'keydate',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page','list_debtor'
            ));
    }

    public function getForm() {
        $model = null;
        $list_location = ThaiHelper::getLocationList();
        $list_type_debtor = ThaiHelper::getTypeDebtorList();
        $list_user_operate = User::where('user_type','=',2)->lists('name','id');  
        $list_user = User::where('user_type','=',3)->lists('name','id');  
        
        return View::make('debtor.form',compact('model','list_user','list_user_operate','list_location','list_type_debtor'));
    }

    public function getFormEdit($id) {
        $list_user_operate = User::where('user_type','=',2)->lists('name','id');  
        $list_user = User::where('user_type','=',3)->lists('name','id');  
        $model = Debtor::find($id);
        $model->date_debtor = ThaiHelper::DateToShowForm($model->date_debtor);
        $model->date_pay = ThaiHelper::DateToShowForm($model->date_pay);
        $list_location = ThaiHelper::getLocationList();
        $list_type_debtor = ThaiHelper::getTypeDebtorList();

        return View::make('debtor.form',compact('model','list_user','list_user_operate','list_location','list_type_debtor'));
    }

    public function postForm() {
        $validation = Debtor::validate(Input::all());
        $validation->setAttributeNames(Finance::attributeName());
        if ($validation->passes()) {
            if(Input::get('id')){
                $model = Debtor::find(Input::get('id'));
                $model->date_debtor = ThaiHelper::DateToDB(Input::get('date_debtor'));
                $model->date_pay = ThaiHelper::DateToDB(Input::get('date_pay'));
                $model->debtor_id = Input::get('debtor_id');
                $model->branch_id = Input::get('branch_id');
                $model->type_debtor = Input::get('type_debtor');
                $model->payable = Input::get('payable');
                $model->pay = Input::get('pay');
                $model->detail = Input::get('detail');
                $model->create_by = Input::get('create_by');
                if($model->save()){
                        return Redirect::action('DebtorController@getIndex');
                }
            }else{
                $model = new Debtor();
                $model->date_debtor = ThaiHelper::DateToDB(Input::get('date_debtor'));
                $model->date_pay = ThaiHelper::DateToDB(Input::get('date_pay'));
                $model->debtor_id = Input::get('debtor_id');
                $model->branch_id = Input::get('branch_id');
                $model->type_debtor = Input::get('type_debtor');
                $model->payable = Input::get('payable');
                $model->pay = Input::get('pay');
                $model->detail = Input::get('detail');
                $model->create_by = Input::get('create_by');
                if($model->save()){
                    return Redirect::action('DebtorController@getIndex');
                }
            }
        }else{
            if(Input::get('id')){
                return Redirect::action('DebtorController@getFormEdit',Input::get('id'))
                            ->withErrors($validation)
                            ->withInput();    
            }else{
                return Redirect::action('DebtorController@getForm')
                            ->withErrors($validation)
                            ->withInput();  
            }
        }
    }

    public function postDelete() {
        $id = Input::get('id');
        $model= Debtor::find($id);
        if($model->delete()){
            return Response::json(array('status' => 'success'));
        }
    }
}
