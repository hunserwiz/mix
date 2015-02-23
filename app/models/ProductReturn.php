<?php

class ProductReturn extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_return';
    protected $primaryKey = 'id';
    
    	public static function validate($input) {
        $rules = array(
            // 'categorise_id' => 'required',    
            // 'product_id' => 'required',
            // 'price' => 'required',
            // 'amount' => 'required',
           'date_return' => 'required',
           'return_by' => 'required',
           'location_id' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            // 'categorise_id' => 'ประเภทสินค้า',    
            // 'product_id' => ' ชื่อสินค้า',
            // 'price' => 'ราคาต่อหน่วย',
            // 'amount'=> 'จำนวนที่คืน',
          'date_return' => 'วันที่คืน',
           'return_by' => 'คืนโดย',
           'location_id' => 'เขตการขาย',
        );

        return $attributes_name;
    }

    public function user(){
          return $this->hasOne('User');
    }

}
?>