<?php

class Webboard extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'webboard';
    protected $primaryKey = 'id';
    
    	public static function validate($input) {
        $rules = array( 
            'topic' => 'required',
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'topic' => 'หัวข้อสนทนา',    
        );

        return $attributes_name;
    }
}
?>