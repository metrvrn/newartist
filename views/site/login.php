<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = 'Вход';
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
                <p>Для входа на сайт просим ввести ваш логин и пароль указанный при регистрации:</p>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин') ?>
                    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
                    <?= $form->field($model, 'rememberMe')->checkbox()->label('Оставаться в системе') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Войти', ['class' => 'btn button-default btn-lg', 'name' => 'login-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
                <div style="color:#999;">
                    <div>
                    Если вы забыли пароль вы можете  <?= Html::a('его восстановить', ['site/requestpasswordreset']) ?>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
