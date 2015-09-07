<?php

class Product extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';
    protected $primaryKey = 'id';
    
    	public static function validate($input) {
        $rules = array(
            'categorise_id' => 'required',    
            'name' => 'required',
            'price' => 'required',
            'flavor' => 'required ',
            'size' => 'required ',
            'product_balance' => 'required|integer',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'categorise_id' => 'ประเภทสินค้า',    
            'name' => ' ชื่อสินค้า',
            'price' => 'ราคาต่อหน่วย',
            'flavor' => 'รส ',
            'size' => 'ขนาด',
            'product_balance' => 'จำนวน',
        );

        return $attributes_name;
    }
    public function productReturnItem(){
          return $this->hasMany('ProductReturnItem');
    }

    public function ordersItem(){
          return $this->hasMany('OrderItem');
    }

    public function depositItem(){
          return $this->hasMany('DepositItem');
    }

    public function categorise($categorise_id){
          $model = Categorise::find($categorise_id);
          return $model->name;
    }
}
?>