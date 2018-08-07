<?php

use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;

$phone = LokalFileModel::getDataByKeyFromLocalfile('local_data_phone');
$watsappNum =  LokalFileModel::getDataByKeyFromLocalfile('watsapp_number');
$viberNum = LokalFileModel::getDataByKeyFromLocalfile('viber_number');
$workingTimeWorkday = LokalFileModel::getDataByKeyFromLocalfile('working_time_workday');
$workingTimeSaturday = LokalFileModel::getDataByKeyFromLocalfile('working_time_saturday');
$workingTimeSunday = LokalFileModel::getDataByKeyFromLocalfile('working_time_sunday');
$workingTime = ((bool) ($workingTimeWorkday or $workingTimeSaturday or $workingTimeSunday));
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
                    Телефон: <?=Html::a($phone, 'tel:'.$phone)?> <br>
                    Адрес: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_adressComppany')?> <br>
                    E-mail: <?=LokalFileModel::getDataByKeyFromLocalfile('local_data_email')?> <br>
                    <?php if(!empty($workingTime)) : ?>
                        Время работы: <br>
                        Пн-Пт - <?= $workingTimeWorkday ? $workingTimeWorkday : 'Нет';?><br>
                        Суббота - <?= $workingTimeSaturday ? $workingTimeSaturday : 'Нет';?><br>   
                        Воскресенье - <?= $workingTimeSunday ? $workingTimeSunday : 'Нет';?><br>
                    <?php endif; ?>
                    <?php if($watsappNum) : ?>
                         <?=Html::a('Watsapp: '.$watsappNum, 'whatsapp://send?phone='.$watsappNum);?><br>
                    <?php endif; ?>
                    <?php if($viberNum) : ?>
                        <?=Html::a('Viber: '.$viberNum, 'viber://add?'.$viberNum);?><br>
                    <?php endif; ?>
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