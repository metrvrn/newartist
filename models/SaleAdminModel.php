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
	public $arrayOrders;
	public $orderId;

 
	
	public function fillArrayOrders(){
		
		 $this->arrayOrders=[];
		 
		 $orders=Order::find()
		 ->all();
		 
		// echo 'alex';
		 if($orders){
			 			 
			 foreach($orders as $order ){
			 
				  
				
			$intArray['id' 					]= $order->id;
			$intArray['userid'				]= $order->userid;
			$intArray['usersessition'		]= $order->usersessition;
			$intArray['summ'				]= $order->summ;
			$intArray['datatime'			]= $order->datatime;
			$intArray['datatimeuploade'		]= $order->datatimeuploade;
			$intArray['status'				]= $order->status;
			$intArray['dуlivery'			]= $order->dуlivery;
			$intArray['payment'				]= $order->payment;		
			$intArray['md5'					]= $order->md5;		
			$intArray['name'				]= $order->name;
			$intArray['email' 				]= $order->email;
			$intArray['phone' 				]= $order->phone;
			$intArray['adress'				]= $order->adress;
			$intArray['comment'				]= $order->comment;
			
			 
				
				
				
				$this->arrayOrders[]=$intArray;
				
				 
				



				
				 
				 
			 }
			 
			 
			 
			 
		 }
		 
		  
		
		
	}
	
	
}
