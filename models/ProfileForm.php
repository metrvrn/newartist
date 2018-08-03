<?php
namespace app\models;
     
    use Yii;
    use yii\base\Model;
     
    /**
     * Signup form
     */
    class ProfileForm extends Model
    {
     
        //public $username;
        //public $email;
        //public $password;
        public $adress;
		public $phone;
		public $name;
	    public $password_reset_token;
	 
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
            
				
				['adress', 'string', 'max' => 255],
				['phone', 'string', 'max' => 255],
				['name', 'string', 'max' => 255],
				['password_reset_token', 'required','message' => 'auto loade'],
				['password_reset_token', 'string', 'max' => 255],
            ];
        }
     
        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
        public function changeProfileData()
        {
     
           $user=User::find()
		   ->where(['password_reset_token'=>$this->password_reset_token])
		   ->one();
		  
		   
		   if($user){
			  
			   $user->adress=$this->adress;
			   $user->phone=$this->phone;
			   $user->name=$this->name;
			   $user->save();
			   
		   }
	 
	 
	 
	 
        }
     
    }