<?php

class Finance extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'account';
    protected $primaryKey = 'id';
    
    public static function validate($input) {
        $rules = array(
            // 'created_at' => 'required ',        	
            'detail' => 'required',
            'price' => 'required',       
            'type' => 'required',
            'create_by' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            // 'created_at' => 'วันที่บันทึก',        	
            'detail' => 'รายละเอียด',
            'price' => '  จำนวนเงิน',  
            'type' => 'ชนิด',     
            'create_by' => 'เจ้าหน้าที่ออกใบเสร็จ ',
        );

        return $attributes_name;
    }

}
?>