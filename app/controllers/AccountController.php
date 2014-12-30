<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AccountController extends BaseController {

    public function getSignIn() {
        return View::make('account.signin');
    }

    public function postSignIn() {
        $validation = Validator::make(Input::all(), array(
            'login_username' => 'required',
            'login_password' => 'required',
        ));
        $validation->setAttributeNames(User::attributeName());
        
        if ($validation->passes()) {
            $auth = Auth::attempt(array(
                        'username' => Input::get('login_username'),
                        'password' => Input::get('login_password'),
                        'is_active' => "1"
                    ));
            if ($auth) {
                    return Redirect::intended('/');
                } else {
                    return Redirect::action('AccountController@getSignIn')
                                    ->with('global', 'Username Or Password Incorrect');
                }
        } else {
            return Redirect::action('AccountController@getSignIn')
                            ->withErrors($validation)
                            ->withInput();
        }
    }
    
    public function getSignOut() {
        Auth::logout();
        return Redirect::action('AccountController@getSignIn');
    }

   
}
