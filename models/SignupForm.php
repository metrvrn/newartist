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
                ['username', 'required', 'message' => 'Введите логин.'],
                ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с таким логином уже зарегистрирован.'],
                ['username', 'string', 'min' => 3, 'max' => 255, 'message' => 'Логин должен содержать от 3 до 255 символов.'],
                ['email', 'trim'],
                ['email', 'required', 'message' => 'Введите Email.'],
                ['email', 'email', 'message' => 'Email введен не корректно.'],
                ['email', 'string', 'max' => 255, 'message' => 'Максимальная длинна Email 255 символов.'],
                ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Пользователь с таким Email уже зарегистрирован.'],
                ['password', 'required', 'message' => 'Введите пароль.'],
                ['password', 'string', 'min' => 6, 'max' => 255, 'message' => 'Пароль должен содержать от 6 до 255 символов.'],
                ['phone', 'required', 'message' => 'Укажите ваш телефон для связи.'],
                ['phone', 'string', 'max' => 255, 'message' => 'Телефон должен содержать не более 255 символов.'],
                ['name', 'string', 'max' => 255, 'message' => 'Имя должен содержать не более 255 символов.'],
                ['adress', 'string', 'max' => 255, 'message' => 'Адрес должен содержать не более 255 символов.'],
               
				
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