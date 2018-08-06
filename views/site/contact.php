<?php

use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-3">
		<?=CatalogMenu::widget(['model' => $catalogModel])?>
  	</div>
    <div class="col-xs-12 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1><?= Html::encode($this->title)?></h1>
            </div>
            <div class="panel-body">
                <p>
                    Телефон: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_phone')?> <br>
                    Адрес: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_adressComppany')?> <br>
                    E-mail: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_email')?> <br>
                </p>
                <script
                    id="yandexMap"
                    type="text/javascript"
                    charset="utf-8"
                    src="<?=LokalFileModel::getDataByKeyFromLocalfile('local_data_yandex_map')?>">
                </script>
            </div>
        </div>
    </div>
</div>
<div id="spinner" class="spinner closed">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<?php $this->registerJsFile("/js/about.js"); ?>