<?php

class Order extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    	
    public static function validate($input) {
        $rules = array(
            'order_date' => 'required ',        	
            'product_id' => 'required',
            'price' => 'required',       
            'amount' => 'required|integer ',
            'agent_id' => 'required',
            'location_id' => 'required',
            'operate_by' => 'required',
            'order_no' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'order_date' => 'วันที่ออกใบสินค้า',        	
            'product_id' => 'สินค้า',
            'price' => ' ราคาต่อหน่วย',       
            'amount' => 'จำนวนสินค้า',
            'agent_id' => ' ตัวแทน',
            'location_id' => 'เขตการขาย',
            'operate_by' => 'เจ้าหน้าที่ออกใบเสร็จ ',
            'order_no' => 'เลขที่ใบเสร็จ',
        );

        return $attributes_name;
    }


    public function GetLocation($id){
        $text = "";
          if($id == 1){
            $text = "พัทยาเหนือ";
          }else if($id == 2){
            $text = "พัทยาใต้";
          }
          return $text;
    }
    
    public function user(){
      return $this->hasOne('User', 'id', 'agent_id');
    }

    public function product(){
      return $this->hasOne('Product', 'id', 'product_id');
    }
}
?>