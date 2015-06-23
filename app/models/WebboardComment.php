<?php

class WebboardComment extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'webboard_comment';
    protected $primaryKey = 'id';
    
    	public static function validate($input) {
        $rules = array( 
            'comment' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'comment' => 'ความคิดเห็น',    
        );

        return $attributes_name;
    }
}
?>