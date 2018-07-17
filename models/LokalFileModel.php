<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class LokalFileModel 
{
      private   $dataArray;
      public $results;
    //public $subject;
    //public $body;
    //public $verifyCode;

	


	
	public static  function getDataByKeyFromLocalfile($key){
		
		$array_line_full=[];
		$value=Yii::$app->cache->get("$key");
		 
		
			if ($value === false){
			 
				 $elementFile = fopen( $_SERVER['DOCUMENT_ROOT'].'/localdata.txt', 'r+');
				 
				while (($line = fgetcsv($elementFile, 0, ";")) !== FALSE) { 
                   $array_line_full[] = $line; 
				   }	;			 
				 //устанавливаем сразу для всех переменных из файла
				  
				  
				  foreach($array_line_full  as $k=>$v)
				  {
					  
					    //value1  key  value2 valeu
 						 
						Yii::$app->cache->set(trim($v[0]), trim($v[1]));
					   
								  
				  }
				  
				
			}
		
		
		$value=Yii::$app->cache->get($key);
		
		Yii::$app->cache->delete($key);
		 
		
		return $value ;
		
	}

	
	 
    /**
     * @return array the validation rules.
     */
   // public function rules()
    //{
     //   return [
            // name, email, subject and body are required
           // [['section', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
           // ['section', 'element'],
            // verifyCode needs to be entered correctly
           // ['verifyCode', 'captcha'],
      //  ];
    //}

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
    // public function contact($email)
    // {
        // if ($this->validate()) {
            // Yii::$app->mailer->compose()
                // ->setTo($email)
                // ->setFrom([$this->email => $this->name])
                // ->setSubject($this->subject)
                // ->setTextBody($this->body)
                // ->send();

            // return true;
        // }
        // return false;
    // }
}
