<?php

class Agent extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agent';
    protected $primaryKey = 'agent_id';
    

    public static function GetNameAgent($agent_id){
          $model = Agent::where('user_id','=',$agent_id)->first();
          if($model){
          		return $model->agent_name . " " .$model->agent_lastname ;
          }else{
          		return "-";
          }
    }
}
?>