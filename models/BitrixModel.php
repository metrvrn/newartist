<?php
     
    namespace app\models;
     
use Yii;
use yii\base\Model;
     
    class BitrixModel extends  Model
    {  
        public	$message;
     
        public function rules()
        {
            return [
                ['message',],
                
            ];
        }
      
     
    }