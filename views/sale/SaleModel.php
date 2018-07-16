<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class SaleModel extends Model
{
	public $message;
    public $userId;
	
	
    public $arrOrdersForCurientUser;
	
				

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [            
            [['userId', ], 'required'],
            
               ];
    }


   public function fillOrdersListForCurientUser()
      { 
	  
	   $this->arrOrdersForCurientUser= [];
	   
	   
	   
			
	   $orders=Order::find()
	   ->where(['userid'=>$this->$userId])
	   ->all();
		 
  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
		  
		  
		  
         $this->message='FillOrdersList order';
    }
}
