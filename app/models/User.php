<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	public static function validate($input) {
        $rules = array(
            // 'prefix' => 'required',    
            'first_name' => 'required',
            'last_name' => 'required',
            'user_type' => 'required ',
            // 'age' => 'required|integer ',
            // 'position' => 'required',
            // 'organization_tel' => 'required|regex:/^\(?([0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
            'email' => 'required|email|max:50',
            'username' => 'required|min:4|max:10',
            'password' => 'required|min:6',
            'password_again' => 'required|same:password|min:6',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'prefix' => 'คำนำหน้าชื่อ',    
            'firstname' => 'ชื่อ',   
            'lastname' => 'นามสกุล',     
            'first_name' => 'ชื่อ',   
            'last_name' => 'นามสกุล',        
            'gender' => 'เพศ',   
            'user_type' => 'ประเภทผู้ใช้งาน ',
            'age' => 'อายุ ',
            'position' => 'ตำแหน่ง ',
            'organization_tel' => 'โทรศัทพ์ ',
            'user_tel' => "มือถือ",
            'fax' => 'โทรสาร',
            'email' => 'อีเมล์',         
            'username' => 'ชื่อผู้ใช้งาน',        
            'password' => 'รหัสผ่าน',
            'password_again' => 'ยืนยันรหัสผ่าน',
        );

        return $attributes_name;
    }
}
