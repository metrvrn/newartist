<?php
    
use yii\helpers\Html;
use app\models\LokalFileModel;
    
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$this->title = "Восстановление пароля на сайте ".LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
?>
    
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($user->username) ?>.</p>
    <p>Вы получили это письмо потому, что вы (либо кто-то, выдающий себя за вас) запросил смену пароля на сайте:
    <?=Html::a(
        LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany'),
        Html::encode(Yii::$app->urlManager->getHostInfo())
    );?></p>
    <p>
        Если вы не просили выслать пароль, то не обращайте внимания на это письмо.
    </p>
    <p>Для смены пароля перейдите по данной <?= Html::a('ссылке', $resetLink) ?></p>
</div>