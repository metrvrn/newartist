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
	
    public $sessionForBasket;
	public $userId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [            
            [['sessionForBasket', ], 'required'],
            
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
   public function makeOrder()
      {
         $this->message='make order';
    }
}
