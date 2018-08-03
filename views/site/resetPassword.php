<?php
    
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\widgets\CatalogMenu;
    
$this->title = 'Изменение пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12"><h1><?= Html::encode($this->title) ?></h1></div>
    <div class="col-xs-12 col-md-3">
        <?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div class="col-xs-12 col-md-offset-2 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
            <p><b>Введите новый пароль</b></p>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn bnt-lg button-default']) ?>
                </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>