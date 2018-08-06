<?php
    
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\widgets\CatalogMenu;
use yii\helpers\Url;
    
$this->title = 'Восстановление пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
     
<div class="row">
    <div class="col-xs-12 col-md-3">
        <?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="panel-body">
                <p>Введите ваше email указанный при регистрации на сайте. На данынй почтовый ящик вы получите письмо для восстановления пароля.</p>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label('Email') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-lg button-default']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>