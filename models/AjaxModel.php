<?php
     
    namespace app\models;
     
use Yii;
use yii\base\Model;
     
    class AjaxModel extends  Model
    {  
        public	$message;
     
        public function rules()
        {
            return [
                ['message',],
                
            ];
        }
      
     
    }