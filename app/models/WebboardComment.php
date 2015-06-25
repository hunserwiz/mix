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
            'comment_by' => 'required', 
            'gender' => 'required',   
        );

        return Validator::make($input, $rules,ThaiHelper::getValidationMessage());
    }

    public static function attributeName() {
        $attributes_name = array(      
            'comment' => 'ความคิดเห็น', 
            'comment_by' => 'ความคิดเห็นโดย', 
            'gender' => 'เพศ',    
        );

        return $attributes_name;
    }

    public function webboard(){
      return $this->hasOne('Webboard', 'id', 'webboard_id');
    }
}
?>