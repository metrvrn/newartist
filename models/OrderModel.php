<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class OrderModel extends Model
{
	public $message;
	public $newOrderId;
	public $newOrderDatetime;
	public $basketArray;
	public $basketSum;
	
    public $sessionForBasket;
	public $userId;
	public $name;
	public $phone;
	public $adress;
	public $email;
				

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [            
            [['sessionForBasket', ], 'required'],
            
               ];
    }


   public function makeOrder()
      {
		  
		  
					$session = Yii::$app->session;
					if ($session->isActive){ 		 

							$this->sessionForBasket=$session->getId();
					};


							if (Yii::$app->user->isGuest){							 
	                         
							}else{		  	 
									$this->userId=Yii::$app->user->id;
								 
								echo  $this->userId.'идентификтор пользователя';
									
	                                $this->name=Yii::$app->user->identity->name;
                                    $this->phone=Yii::$app->user->identity->phone;
									$this->adress=Yii::$app->user->identity->adress;
									$this->email=Yii::$app->user->identity->email;
									 
							}
		  
		  
		  
		  $order=new Order();
		    $order->coment='coment';
			if(isset($this->userId)){
			
			$order->userid=$this->userId;	
				
			}
			$order->datatime=date('Y-m-d H:i:s');
			$order->usersessition=$this->sessionForBasket;	
			
			$order->md5=md5($this->sessionForBasket);
			
			 
			$order->save();
			
			
			
			
			$this->newOrderId=$order->id;
			$this->newOrderDatetime=$order->datatime;;
			
			
			
		 
 
 
 
 
 
 
 
 
 
 
 
 
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
		  ->where(['sessionid' =>  $sessionIdArray]) 
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
													$elements=Element::find()
													->where(['id'=>$intArrayOfIdElementInBasket])
													->all();

													if($elements){
														foreach($elements as $element){
															
															$nameArray[$element[id]]=$element['name'];
															
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
		 
		 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
		  
		  
		  
         $this->message='make order';
    }
}
