<?php

class Order extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    	
    public static function validate($input) {
        $rules = array(
            'order_date' => 'required ',        	
            // 'product_id' => 'required',
            // 'price' => 'required',       
            // 'amount' => 'required|integer ',
            'agent_id' => 'required',
            'location_id' => 'required',
            'operate_by' => 'required',
            'order_no' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function validationStock($product){
        if(!empty($product)){
            foreach ($product as $key => $value) {
                if($value['stock'] < $value['amount']){
                    return false;
                }
            }
            return true;
        }else{
            return false;
        }
    }

    public static function attributeName() {
        $attributes_name = array(      
            'order_date' => 'วันที่ออกใบสินค้า',        	
            // 'product_id' => 'สินค้า',
            // 'price' => ' ราคาต่อหน่วย',       
            // 'amount' => 'จำนวนสินค้า',
            'agent_id' => ' ตัวแทน',
            'location_id' => 'เขตการขาย',
            'operate_by' => 'เจ้าหน้าที่ออกใบเสร็จ ',
            'order_no' => 'เลขที่ใบเสร็จ',
        );

        return $attributes_name;
    }

    public function user(){
      return $this->hasOne('User', 'id', 'agent_id');
    }


    public function orderItem(){
      return $this->hasMany('OrderItem', 'order_id', 'order_id');
    }

    // public function product(){
    //   return $this->hasOne('Product', 'id', 'product_id');
    // }
}
?>