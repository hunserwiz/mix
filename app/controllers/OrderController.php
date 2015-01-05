<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class OrderController extends BaseController {

    public function getIndex() {
    	$model = Order::all();
        return View::make('order.index',compact('model'));
    }
    public function getForm() {
        return View::make('order.form');
    }
     public function getFormEdit() {
        return View::make('order.form');
    }
    public function postBill() {

    }
    
 
}
