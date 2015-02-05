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
            'categorise_id' => 'required',       
            'product_id' => 'required',
            'type_deposit' => 'required',
            'price' => 'required', 
            'amount' => 'required',            
            'deposit_by' => 'required',
            'create_by' => 'required',
            'date_return_deposit' => 'required',    
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'date_deposit' => 'วันที่ฝาก',    
            'categorise_id' => 'ประเภทสินค้า',       
            'product_id' => 'สินค้า',
            'type_deposit' => 'ประเภทการฝากสินค้า',    
            'price' => 'ราคา',      
            'amount' => 'จำนวนสินค้า',            
            'deposit_by' => 'ผู้ฝาก',
            'create_by' => 'ผู้รับฝาก',
            'date_return_deposit' => 'วันรับคืน',    
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
}
?>