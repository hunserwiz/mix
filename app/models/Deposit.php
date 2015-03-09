<?php

class Deposit extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deposit';
    protected $primaryKey = 'id';
    
    public static function validate($input) {
        $rules = array(
            'date_deposit' => 'required',    
            'type_deposit_id' => 'required',       
            'deposit_by' => 'required',
            'create_by' => 'required',
            'date_deposit_return' => 'required',    
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'date_deposit' => 'วันที่ฝาก',    
            'type_deposit_id' => 'ประเภทการฝากสินค้า',    
            'deposit_by' => 'ผู้ฝาก',
            'create_by' => 'ผู้รับฝาก',
            'date_deposit_return' => 'วันรับคืน',    
        );

        return $attributes_name;
    }

    public function categorise(){
          return $this->hasOne('Categorise','categorise_id','categorise_id');
    }

    public function product(){
          return $this->hasOne('Product','id','product_id');
    }

    public function user(){
      return $this->hasOne('User');
    }

    public static function GetTypeDeposit($type_id){
        $text = "";
        if($type_id == 1){
            $text = "ฝากกลับบ้าน";
        }else{
            $text = "ฝากในตู้";
        }    
        return $text;
    }
}
?>