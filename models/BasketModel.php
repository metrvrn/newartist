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
	 
	public $idForChangeBasket;
    public $quantityForChangeBasket;
	 
	 
	 
	 public $basketArray;
	 public $basketSum;
	
	

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
		  
		  $mes=$this->sessionForBasket;
		 
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
	 
         $this->message= ' message {"quantity":"'.$this->quantityForAddToBasket.'" }';
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
		  ->where(['sessionid' =>  $sessionIdArray, 'zakazid'=>null]) 
		 ->all();
		 
		 if($baskets){
			   
			   
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
				 
				 
				  $codeArray=[];
				  $nameArray=[];
				  
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
					
				 	$this->basketArray[]=$intForeach;
				
			}
			
			
			
	 
			 
		 }
		 
		 
		 
		 

		 
		 
		 
		 
		 
	 }
	 
	 
	
	 public function changeBasketViaId(){
		 
		 
		 $basket=Basket::find()
		 ->where(['id'=>$this->idForChangeBasket])
		 ->one();
		 
		 if($basket){
			 
			 $basket->quantity=$this->quantityForChangeBasket;
			  $basket->sum=$this->quantityForChangeBasket*$basket->price;;
			  $basket->save();
			 
		 }
		 
		 
		 
	 }
	 
	 
}
