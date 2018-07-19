<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ZakazForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $adress;
	public $comment;
   


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone',], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
			['comment', 'string'],
            // verifyCode needs to be entered correctly string
          //  ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
       // return [
       //     'verifyCode' => 'Verification Code',
       // ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
   /*  public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    } */
	
	
	
	
}
