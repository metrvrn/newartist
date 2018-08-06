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
            <div class="panel-heading">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    ]); ?>
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Логин*') ?>
                    <?= $form->field($model, 'password')->passwordInput()->textInput()->label('Пароль*') ?>
				    <?= $form->field($model, 'email')->textInput()->label('Email*') ?>
                    <?= $form->field($model, 'phone') ->textInput()->label('Телефон*')?>
                    <?= $form->field($model, 'name')->textInput()->label('ФИО') ?>
                    <?= $form->field($model, 'adress')->textInput()->label('Адрес') ?>
                    <div class="form-group">
                        <?= Html::submitButton(
                            'Зарегестрироваться',
                            ['class' => 'btn btn-lg button-default',
                            'id' => 'signupButton',
                            'disabled' => true,
                            'name' => 'signup-button']
                        )?>
                    </div>
                <?php ActiveForm::end(); ?>
                <div class="signup-privacy-wrapper">
                    <input type="checkbox" id="privacyCheckbox">
                    <span>Регистрируясь я принимаю соглашение на обработку моих персональных данных.</span>
                </div>
                <p>Поля отмеченные * обязательны для заполнения</p>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJsFile('/js/signup.js',  ['position' => yii\web\View::POS_END]); ?>