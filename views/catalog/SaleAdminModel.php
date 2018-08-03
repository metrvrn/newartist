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
class SaleAdminModel  
{
 
	public $message;
    public  $arrayOrders;
 
	
	public function fillArrayOrders(){
		
		 
		$this->arrayOrders=[];
		
		$orders=Order()::find()
		->all();
		
		if($orders){
			
			foreach($orders as order){
				
				$intArray=[];
			$intArray['id']=$order->id;
			$intArray['md5']=$order->md5;
			$this->arrayOrders[]=$intArray;
				
			}
			
			
			
			
		}
		
		
		
		
	}
	
	
}
