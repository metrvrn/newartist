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
 
				

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [            
            [['sessionForBasket', ], 'required'],
            
               ];
    }


   public function fillOrdersListForCurientUser()
      { 
			
	  
		 
  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 

 
 
		  
		  
		  
         $this->message='FillOrdersList order';
    }
}
