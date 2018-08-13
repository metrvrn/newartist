<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\LokalFileModel;

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
	public $md5;
 
	
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
	
	
	
	public function sendOrderToSite(){
		
		$mainArray=[];
		$orderArray=[];
		
		$order=Order::find()
		->where(['md5'=>$this->md5])
		->one();
		
		if($order){	}else{return;}
		
		
		
			$userId=LokalFileModel::getDataByKeyFromLocalfile('local_data_default_site_order');
			
			$orderArray['userid'] = $userId;
			
			$orderArray['id'] = $order->id;
			$orderArray['userid'] = $order->userid;
			$orderArray['usersessition'] = $order->usersessition;
			$orderArray['summ'] = $order->summ;
			$orderArray['datatime'] = $order->datatime;
			$orderArray['datatimeuploade'] = $order->datatimeuploade;
			$orderArray['status'] = $order->status;
			$orderArray['dуlivery'] = $order->dуlivery;
			$orderArray['payment'] = $order->payment;
			$orderArray['md5'] = $order->md5;
			$orderArray['name'] = $order->name;
			$orderArray['email'] = $order->email;
			$orderArray['phone'] = $order->phone;
			$orderArray['adress'] = $order->adress;
			$orderArray['comment'] = $order->comment;
			$orderArray['index'] = $order->index;
		
		
		
		
		$comment='заказ интернет магазина художник //';
		
		$baskets=Basket::find()
		->where(['zakazid'=>$order->id])
		->all();
		
		$itemsArray=[];
		$idArray=[];
		$elementArray=[];
		if($baskets){}else{return;}
		
		foreach($baskets as $basket){				
			$idArray=$basket->elementid;
				
		}
			
		$elements=Element::find()
				->where(['id'=>$idArray])
				->all();
				
		foreach($elements as $element){
			$elementArray[$element->id]=$element->xmlcode;	 
			
		}
			
			
			
		
		
		foreach($baskets as $basket){
			$intArray=[];
			$intArray['id']=$basket->id;
			$intArray['userid']=$basket->userid;
			$intArray['sessionid']=$basket->sessionid;
			$intArray['elementid']=$basket->elementid;
			$intArray['elementxmlcode']=$elementArray[$basket->elementid]   ;
			$intArray['sum']=$basket->sum;
			$intArray['quantity']=$basket->quantity;
			$intArray['zakazid']=$basket->zakazid;
			$intArray['order']=$basket->order;
			$intArray['price']=$basket->price;
			
			$itemsArray[]=$intArray;
			
		}
		
		
			$mainArray['items']=$itemsArray;
			$mainArray['orderdata']=$orderArray;
			

		$order->status=2;
		$order->save();
		
		
		$url=LokalFileModel::getDataByKeyFromLocalfile('local_data_default_site_order');
		
		//$this->message=$url;
		
		
		            if($curl = curl_init()) { 
					curl_setopt($curl,CURLOPT_URL, $url);
					curl_setopt($curl, CURLOPT_POST, 1);	
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($mainArray));					
					curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
					curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
					curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,30); 
					curl_setopt($curl,CURLOPT_USERAGENT,'Bot 5555.0');
					$html = curl_exec($curl);
					curl_close($curl);
					}
					
					 
					
				 $arrProp=$html;//json_decode($html); 
		
		          $this->message=$this->message.$html;
		
	}
	
	
	
}
