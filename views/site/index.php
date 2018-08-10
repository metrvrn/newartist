<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
?>
<div class="div">
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title">Галлерея</h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div id="links" class="col-xs-12 col-md-9">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6">
                    <a href="/images/store-image-small/1.jpg">
                        <img class="img-responsive" src="/images/store-image-small/1.jpg">
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="/images/store-image-small/2.jpg">
                        <img class="img-responsive" src="/images/store-image-small/2.jpg">
                    </a>
                </div>
            </div>
            <div class="row"><div style="height: 15px;"></div></div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="/images/store-image-small/3.jpg">
                        <img class="img-responsive" src="/images/store-image-small/2.jpg">
                    </a>
                </div>
                <div class="col-xs-6">
                    <a href="/images/store-image-small/4.jpg">
                        <img class="img-responsive" src="/images/store-image-small/4.jpg">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->registerJsFile("js/blueimp-gallery.min.js", ['position' =>  yii\web\View::POS_END]); ?>
<?php $this->registerJsFile("js/image-galery.js", ['position' =>  yii\web\View::POS_END]); ?>