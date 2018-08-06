<?php
     
namespace app\models;
     
use Yii;
use yii\base\Model;
use app\models\LokalFileModel;
    
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required', 'message' => 'Для восстановления пароля необходим ваш email.'],
            ['email', 'email', 'message' => 'Неверный email.'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'Пользователь с таким email не найден.'
            ],
        ];
    }
    
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
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
    
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => 'Интернет магазин: ' . LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')])
            ->setTo($this->email)
            ->setSubject('Восстановления пароля сайта ' . LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany'))
            ->send();
    }
    
}