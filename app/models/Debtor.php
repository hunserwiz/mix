<?php

class Debtor extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'debtor';
    protected $primaryKey = 'id';
    
    public static function validate($input) {
        $rules = array(
            'payable' => 'required',    
            'pay' => 'required',       
            'debtor_id' => 'required',
            'detail' => 'required',            
            'create_by' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'payable' => 'จำนวนเงินที่ค้างชำระ',    
            'pay' => 'จำนวนเงินที่จ่าย',       
            'debtor_id' => 'ลูกหนี้',     	
            'detail' => 'รายละเอียด',
            'create_by' => 'เจ้าหน้าที่ออกใบเสร็จ ',
        );

        return $attributes_name;
    }
    public function user(){
      return $this->hasOne('User', 'id', 'debtor_id');
    }
}
?>