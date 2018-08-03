<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\widgets\CatalogMenu;

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' =>  $model->password_reset_token]);
?>
<div class="row">
    <div class="col-xs-12"><h1><?= Html::encode($this->title) ?></h1></div>
    <div class="col-xs-12 col-md-3">
        <?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4>
                    Логин: <?=$model->username;?> <br>
                    Email: <?=$model->email;?>
                </h4>
                <hr>
                <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
                    <?= $form->field($modelProfileForm, 'name')->textInput()->label('Имя') ?>
                    <?= $form->field($modelProfileForm, 'phone') ->textInput()->label('Телефон')?>
                    <?= $form->field($modelProfileForm, 'adress')->textInput()->label('Адрес') ?>
                    <?= Html::activeHiddenInput($modelProfileForm, 'password_reset_token') ?>
                        <div class="form-group">
                            <?= Html::submitButton('Изменить данные', ['class' => 'btn btn-lg button-default', 'name' => 'signup-button']) ?>
                        </div>
                <?php ActiveForm::end(); ?>
                <p style="color: #ddd"><?= Html::a('Изменение пароля', $resetLink) ?></p>
            </div>
        </div>

    </div>
</div>