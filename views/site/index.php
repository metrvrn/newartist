<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'Художник';
?>
<div class="index-btn-align">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-lg-offset-2">
                <a href="<?=Url::toRoute("catalog/index")?>" class="btn btn-lg btn-default">
                    <h2><?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?></h2>
                </a>
            </div>
            <div class="col-lg-3 col-lg-offset-2">
                <a href="<?=Url::toRoute("about/index")?>" class="btn btn-lg btn-default">
                    <h2><?=LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany')?></h2>
                </a>
            </div>
        </div>
    </div>
</div>
