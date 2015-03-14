<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends BaseController {

    public function getIndex() {
        $keyword = "";

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

        return View::make('account.index',compact(
                                        'model',
                                        'count_model',
                                        'keyword',
                                        'arr_list_page',
                                        'arr_perpage',
                                        'arr_page',
                                        'arr_count_page'
                                        ));
    }

   
}
