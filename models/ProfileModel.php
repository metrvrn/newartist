<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class ProfileModel extends Model
{
	public $message;
	public $userId;
	public $name;
	public $username;
	public $phone;
    public $adress;
	public $email;	
    public $password_reset_token;	

    /**
     * @return array the validation rules.
     */
   

 
	public function validatePassword_reset_token(){
		
		
		        $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'id' => $this->userId,
            ]);
     
            if (!$user) {
                return false;
            }
     
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
                if (!$user->save()) {
                    return false;
                }
            }
		
		
	}
 
	

	public function fillDataUserById(){
		
		
		   $user = User::findOne([
               'id' => $this->userId,
            ]);
		
		if($user){
			
			           	
						    $this->username=$user->username;
							$this->name=$user->name;
                            $this->phone=$user->phone;
							$this->adress=$user->adress;
							$this->email=$user->email;
							$this->password_reset_token=$user->password_reset_token;
							
						
			
			
			
			
			
		}
		
		
		
		
	}
	
 
	
	}
