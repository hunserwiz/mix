<?php

class ProductReturnItem extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products_return_item';
    protected $primaryKey = 'id';
    
    public function product(){
          return $this->hasOne('Product','id','product_id');
    }

    public function user(){
          return $this->hasOne('User');
    }

}
?>