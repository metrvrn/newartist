<?php
namespace app\models;
     
    use Yii;
    use yii\base\Model;
     
    /**
     * Signup form
     */
    class SignupForm extends Model
    {
     
        public $username;
        public $email;
        public $password;
        public $adress;
		public $phone;
		public $name;
	 
	 
        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                ['username', 'trim'],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
                ['username', 'string', 'min' => 2, 'max' => 255],
                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
                ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
                ['password', 'required'],
                ['password', 'string', 'min' => 6],
				
				 ['adress', 'string', 'max' => 255],
				 ['phone', 'string', 'max' => 255],
				 ['name', 'string', 'max' => 255],
				
            ];
        }
     
        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
        public function signup()
        {
     
            if (!$this->validate()) {
                return null;
            }
     
            $user = new User();
            $user->username = $this->username;
			  $user->phone = $this->phone;
			   $user->name = $this->name;
			  
			    $user->adress = $this->adress;
				
			  
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            return $user->save() ? $user : null;
        }
     
    }