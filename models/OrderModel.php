<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\LokalFileModel;



class OrderModel extends Model
{
	public $message;
	public $newOrderId;
	public $newOrderDatetime;
	public $arrOrderElements;
	
	public $orderId;
	
	public $basketArray;
	public $basketSum;
	
	
	public $orderMd5;
    public $sessionForBasket;
	public $userId;
	
	
	public $md5;
	public $name;
    public $email;
    public $phone;
    public $adress;
	public $comment;
				
    
	
    public function rules()
    {
        return [            
            [['sessionForBasket', ], 'required'],
            
               ];
    }
   public function makeOrder()
      {
		  
		  
		  if (Yii::$app->user->isGuest){							 
	                         
							}else{		  	 
									$this->userId=Yii::$app->user->id;
								 
								
									
	                                $this->name=Yii::$app->user->identity->name;
                                    $this->phone=Yii::$app->user->identity->phone;
									$this->adress=Yii::$app->user->identity->adress;
									$this->email=Yii::$app->user->identity->email;
									 
							}
		  
		  
					$session = Yii::$app->session;
					if ($session->isActive){ 		 
							$this->sessionForBasket=$session->getId();
					};
							
		  
		  
		  
		  $order=new Order();
		   
			if(isset($this->userId)){
			
			$order->userid=$this->userId;	
				
			}
			
			
			$order->datatime=date('Y-m-d H:i:s');
			$order->usersessition=$this->sessionForBasket;	
			
			$order->md5=md5($this->sessionForBasket.$order->datatime);
			
			$order->name=$this->name;
			$order->status=1;
			$order->email=$this->email;
			$order->phone=$this->phone; 
			$order->adress=$this->adress;
			$order->comment=$this->comment;
			
			$order->save();
			
			$this->newOrderId=$order->id;
			$this->md5=$order->md5;
			$this->orderId =$order->id;
			
			$this->newOrderDatetime=$order->datatime;;
			$this->orderMd5=$order->md5;
			
			
		 
 
 
 
 
 
 
 
 
 
 
 
 
         $this->basketArray=[];
		 $sessionIdArray=[];
		 $sessionIdArray[]=$this->sessionForBasket;
		 
		 if(isset ($this->userId)){
			 
			 $sessionForUserInDB=Usersessitions::find()
			  ->where(['userid' =>  $this->userId])
			  ->all();
			  
			  
			  if($sessionForUserInDB){
				  
				  
				  
				  foreach( $sessionForUserInDB as $val  ){
					  
					  $sessionIdArray[]=$val->session;  
					  
				  };
				  
				
				  
				  
			  }
			 
			 
			 
			 
			 
		 };
		 
		 
		 $baskets=  Basket::find()
		  ->where(['sessionid' =>  $sessionIdArray, 'zakazid'=>null]) 
		 ->all();
		 
		 if($baskets){
			                                          
			                                           ///image for order elements  and name
												   $intArrayOfIdElementInBasket=[];							   
												   
												   foreach($baskets as $basket){
														$intArrayOfIdElementInBasket[]=$basket['elementid']; 
																												   
												   }											   
												   
													$imagesArray=[];
													 $imagesArrayDetail=[];													
													 $images=Image::find()
													 ->where(['elementid'=>$intArrayOfIdElementInBasket])
													 ->all();
													if($images){														
														foreach($images as $image){															
															$imagesArray[$image['elementid']]=$image['filep'];															
															$imagesArrayDetail[$image['elementid']]=$image['filed'];														
														}		
														
													}	
				 				 
				 
													$nameArray=[];
													$codeArray=[];
													$elements=Element::find()
													->where(['id'=>$intArrayOfIdElementInBasket])
													->all();
													if($elements){
														foreach($elements as $element){
															
															$nameArray[$element[id]]=$element['name'];
															$codeArray[$element[id]]=$element['code'];
															
														}
													}
			
				$this->basketSum=0;
			
			foreach($baskets as $basket  ){
				
				
				    $intForeach=[];
					$intForeach['id']=$basket['id'];
					$intForeach['userid']=$basket['userid'];
					$intForeach['sessionid']=$basket['sessionid'];
					$intForeach['elementid']=$basket['elementid'];
					$intForeach['price']=$basket['price'];
					$intForeach['sum']=$basket['sum'];
					$intForeach['quantity']=$basket['quantity'];
					
					if(isset($nameArray[$basket['elementid']])){
						$intForeach['name']=$nameArray[$basket['elementid']];
						$intForeach['code']=$codeArray[$basket['elementid']];
						
					}else{     
					
					$intForeach['image']='not';
					}
					
					
					
					if(isset($imagesArray[$basket['elementid']])){
						$intForeach['image']=$imagesArray[$basket['elementid']];
						$intForeach['imagd']=$imagesArrayDetail[$basket['elementid']];
						
					}else{     
					$intForeach['imagd']='not';
					$intForeach['image']='not';
					}
					
					
					
					$this->basketSum=$this->basketSum+$basket['sum']; 
					
					//save  order id in basket table 
					
					$basket->zakazid=$order->id;
					$basket->save();
					
					
					
					
				 	$this->basketArray[]=$intForeach;
				
			}
			
			
			
			
			$order->summ=$this->basketSum;
			$order->save();
			
	 
			 
		 }
		 
		 
 
			
 
 
 
 
 
 
		  
		  
		  
         $this->message='ok';
    }
	
	
	public function fillArrOrderElements(){
		
		
		$this->basketArray=[];
		
		$order=Order::find()
		->where(['md5'=>$this->orderMd5])
		->one();
		if($order){
			
			
			$this->name     =$order->name;
			$this->email    =$order->email;
			$this->phone    =$order->phone;
			$this->adress   =$order->adress;
			$this->comment  =$order->comment;
			$this->orderId  =$order->id;
			
			
			//
			//echo $this->orderMd5;
			
			//echo $this->orderMd5;
			
			  $baskets=Basket::find()
			  ->where(['zakazid'=>$order->id])
			  ->all();
			  
			  
			 // echo $order->id;
			  
			  
					 if($baskets){
			                                          
			                                           ///image for order elements  and name
												   $intArrayOfIdElementInBasket=[];							   
												   
												   foreach($baskets as $basket){
														$intArrayOfIdElementInBasket[]=$basket['elementid']; 
																												   
												   }											   
												   
													$imagesArray=[];
													 $imagesArrayDetail=[];													
													 $images=Image::find()
													 ->where(['elementid'=>$intArrayOfIdElementInBasket])
													 ->all();
													if($images){														
														foreach($images as $image){															
															$imagesArray[$image['elementid']]=$image['filep'];															
															$imagesArrayDetail[$image['elementid']]=$image['filed'];														
														}		
														
													}	
				 				 
				 
													$nameArray=[];
													$codeArray=[];
													
													$elements=Element::find()
													->where(['id'=>$intArrayOfIdElementInBasket])
													->all();
													if($elements){
														foreach($elements as $element){
															
															$nameArray[$element[id]]=$element['name'];
															$codeArray[$element[id]]=$element['code'];
															
														}
													}
			
													$this->basketSum=0;
												
											foreach($baskets as $basket  ){
											
												
													$intForeach=[];
													$intForeach['id']=$basket['id'];
													$intForeach['userid']=$basket['userid'];
													$intForeach['sessionid']=$basket['sessionid'];
													$intForeach['elementid']=$basket['elementid'];
													$intForeach['price']=$basket['price'];
													$intForeach['sum']=$basket['sum'];
													$intForeach['quantity']=$basket['quantity'];
													
													if(isset($nameArray[$basket['elementid']])){
														$intForeach['name']=$nameArray[$basket['elementid']];
														$intForeach['code']=$codeArray[$basket['elementid']];
														
													}else{     
													
													$intForeach['image']='not';
													}
													
													
													
													if(isset($imagesArray[$basket['elementid']])){
														$intForeach['image']=$imagesArray[$basket['elementid']];
														$intForeach['imagd']=$imagesArrayDetail[$basket['elementid']];
														
													}else{     
													$intForeach['imagd']='not';
													$intForeach['image']='not';
													}
													
													
													
													$this->basketSum=$this->basketSum+$basket['sum']; 
													
													//save  order id in basket table 
													
													$basket->zakazid=$order->id;
													$basket->save();
													
													
													
													
													$this->basketArray[]=$intForeach;
								
											}
			
			
			
			
			 
			
	 
			 
					}
			
			 
			
		}
		
		
		
		
	}
	
	
	
	public function sendOrderToCustomer(){
	
	
	
		if(isset($this->email)){
			
				Yii::$app
					->mailer
					->compose(
						['html' => 'sendOrderToCustomer-html', 'text' => 'sendOrderToCustomer-text'],
						['order' => $this]
					)
					->setFrom([LokalFileModel::getDataByKeyFromLocalfile('local_data_email_admin_for_order') => "Интернет магазин " . LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')])
					->setTo($this->email)
					->setSubject('Заказ № ' . $this->orderId)
					->send();
			
		}
	
	  
	
	
	
	}
	
		public function sendOrderToAdmin(){
	
	
	
		if(isset($this->email)){
			
				Yii::$app
					->mailer
					->compose(
						['html' => 'sendOrderToAdmin-html', 'text' => 'sendOrderToAdmin-text'],
						['order' => $this]
					)
					->setFrom([LokalFileModel::getDataByKeyFromLocalfile('local_data_email_admin_for_order') => "Интернет магазин " . LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')])
					->setTo(LokalFileModel::getDataByKeyFromLocalfile('local_data_email_admin_for_order'))
					->setSubject('Заказ № ' . $this->orderId)
					->send();
			
		}
	
	  
	
	
	
	}
	
	
}

?>