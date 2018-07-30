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
            <div class="panel-body">
                <h1><?= Html::encode($this->title)?></h1>
                <p>
                    Телефон: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_phone')?> <br>
                    Адрес: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_adressComppany')?> <br>
                    E-mail: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_email')?> <br>
                </p>
                <script
                    type="text/javascript"
                    charset="utf-8"
                    async
                    src="<?=LokalFileModel::getDataByKeyFromLocalfile('local_data_yandex_map')?>">
                </script>
            </div>
        </div>
    </div>
</div>