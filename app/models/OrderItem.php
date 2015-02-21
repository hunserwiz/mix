<?php

class OrderItem extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_item';
    protected $primaryKey = 'id';
    	
    
    public function product(){
      return $this->hasOne('Product', 'id', 'product_id');
    }
}
?>