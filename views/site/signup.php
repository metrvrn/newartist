<?php
    
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-xs-12 col-md-3">
    <?=CatalogMenu::widget(['model' => $catalogModel])?>
</div>
    <div class="col-xs-12 col-md-offset-2 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1><?= Html::encode($this->title) ?></h1>
                <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    ]); ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин') ?>
                    <?= $form->field($model, 'password')->passwordInput()->textInput()->label('Пароль') ?>
					<?= $form->field($model, 'name')->textInput()->label('ФИО') ?>
				   <?= $form->field($model, 'email')->textInput()->label('Email') ?>
                    <?= $form->field($model, 'phone') ->textInput()->label('Телефон')?>
                    <?= $form->field($model, 'adress')->textInput()->label('Адрес') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Зарегестрироваться', ['class' => 'btn btn-lg button-default', 'name' => 'signup-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>