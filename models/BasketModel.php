<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Basket;
use app\models\Image;
use app\models\Price;

use app\models\Usersessitions;

/**
 * ContactForm is the model behind the contact form.
 */
class BasketModel extends Model
{
	public $message;
	
      //add element to bssket
	public $elementForAddToBasket;
    public $sessionForBasket;
	public $userId;
	public $quantityForAddToBasket;
	 
	 
	 public $basketArray;
	
	

    /**
     * @return array the validation rules.
     */
   public function rules()
    {
        return [
                [['elementForAddToBasket', 'sessionForBasket', 'userId','quantityForAddToBasket'], 'safe'],
       ];
    }

   
     public function addElementToBasket()
     {   $mes='';
	 
	 

         $basket=new Basket();
		 $basket->userid= $this->userId;
		 $basket->sessionid= $this->sessionForBasket;
		  
		 
		 $price=Price::find()
		 ->where(['elementid'=>$this->elementForAddToBasket])
		 ->one();
		 if(!$price){			 
			 $this->message='no price';
			 return;
		 }else{
			 $basket->price=$price['price'];
			 
		 }
		 
		 
		 
		 
		 
		 
		 
		 $basket->elementid=$this->elementForAddToBasket;		 
		 $basket->quantity = floatval($this->quantityForAddToBasket);
		 
		  $basket->sum=$basket->price*$basket->quantity ;
		 
			
		$basket->save();
	 
         $this->message='add to basket';
     }
	 
	 
	 
	 public function fillBasketArray(){
		 
		 
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
			   
			   
			   $intArrayOfIdElementInBasket=[];
			   
			   
			   foreach($baskets as $basket){
				    $intArrayOfIdElementInBasket[]=$basket['elementid']; 
					
							   
			   }
			   
			   
			    $imagesArray=[];
			     $images=Image::find()
				 ->where(['elementid'=>$intArrayOfIdElementInBasket])
				 ->all();

				if($images){
					
					foreach($images as $image){
						
						$imagesArray[$image['elementid']]=$image['filep'];
						
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
						
					}else{     
					
					$intForeach['image']='not';
					}
					
					
					
					
					
				 	$this->basketArray[]=$intForeach;
				
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			 
			 
		 }
		 
		 
		 
		 
		 //finde all chaild of id.
		     //    $elements = Element::find()
				 
				// ->orderBy("name")				
				// ->offset( intval( $this->page*$this->elementPerPage))
				//  ->limit(intval($this->elementPerPage))
				 //->where(['idp' =>ltrim(  $startCode )])
				// ->all();
		 
		 
		 
		 
		 
		 
	 }
	 
	 
	 
}
