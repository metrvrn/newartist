<?php
    
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;
use yii\helpers\Html;

$this->title = 'Соглашение на обработку персональных данных';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-xs-12 col-md-3">
    <?=CatalogMenu::widget(['model' => $catalogModel])?>
</div>
    <div class="col-xs-12 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="panel-body">
                <p>
                Принимая условия данного соглашения, пользователь дает свое согласие на сбор,
                хранение и обработку своих персональных данных, указанных путем заполнения
                веб-форм на сайте <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?> <br>
                Перечень персональных данных передаваемых на обработку: <br>
                <ul>
                    <li>ФИО</li>
                    <li>Адрес</li>
                    <li>E-mail</li>
                    <li>Телефон</li>
                </ul>
                Основанием для обработки персональных данных являются: статья 24 Конституции РФ и статья 6 Федерального закона № 152-ФЗ «О персональных данных» с дополнениями и изменениями.
                </p>
            </div>
        </div>
    </div>
</div>