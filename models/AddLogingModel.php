<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\Usersessitions;
/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class AddLogingModel  
{
 
	public $oldsession;

 
	
	public function addOldSessionForUser(){
		
		
		if(isset($this->oldsession)){
			
			//echo('   addOldSessionForUser  ');
			
			$session= new Usersessitions();
			
			$session->userid=Yii::$app->user->id;
			$session->session=$this-oldsession;
			$session->save(); 
			
			
			echo $this-oldsession;
			echo $this-username;
			
			
		}
		
		
		
		
	}
	
	
}
