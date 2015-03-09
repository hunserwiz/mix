<?php

class DepositItem extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'deposit_item';
    protected $primaryKey = 'id';
    	
    
    public function product(){
      return $this->hasOne('Product', 'id', 'product_id');
    }
}
?>