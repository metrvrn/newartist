<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Basket;

use app\models\Usersessitions;

/**
 * ContactForm is the model behind the contact form.
 */
class BasketModel extends Model
{
      //add element to bssket
	public $elementForAddToBasket;
    public $sessionForBasket;
	 public $userId;
	 
	 
	 public $basketArray;
	
	

    /**
     * @return array the validation rules.
     */
   public function rules()
    {
        return [
                [['elementForAddToBasket', 'sessionForBasket', 'userId'], 'safe'],
       ];
    }

    /**
     * @return array customized attribute labels
     */
    // public function attributeLabels()
    // {
        // return [
            // 'verifyCode' => 'Verification Code',
        // ];
    // }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
     public function addElementToBasket()
     {   
	 
	 

           $basket=new Basket();
		
		   
		   
		   $basket->userid= $this->userId;
			 $basket->sessionid= $this->sessionForBasket;
			 $basket->price=12.5;
			 
			 $basket->elementid=$this->elementForAddToBasket;
			 
			 
			 
			// $el->quantity ='0';
		     $basket->quantity = 1;
			 //$basket->index1 = $el->index1;
			 //$basket->index2 =$el->index2;
			 
			 
			 
			//'id' => $this->primaryKey(),
			//'userid'=> $this->integer(),
			//'sessionid'=> $this->string(),
			
			//'elementid'=> $this->integer(),
			//'price'=> $this->integer(),
			//'sum'=> $this->float(),
			//'quantity'=> $this->float(),
			//'zakazid'=> $this->string(),
			//'order'=> $this->boolean(), 
			//'price'=> $this->float(), 
			   // echo 'alex';
		$basket->save();
	 
         //return false;
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
			   
			   foreach($baskets as $basket){
				   
				   $itArray=[];
				  $itArray['elementid']=$basket->elementid;
				  $itArray['sessionid']=$basket->sessionid;
				  
				  $this->basketArray[]=$itArray;
				  
				   
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
