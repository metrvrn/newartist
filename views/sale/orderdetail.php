<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'данные заказа';
?>
<div class="div">

<div class="row">
	<div class="col-xs-12 col-md-3">
	   <?echo $this->title;  ?>
	   <br>
	   $this->newOrderId-
	   <?echo $model->newOrderId;  ?>
	</div>
    <div id="links" class="col-xs-12 col-md-9">
       
    </div>
</div>
</div>