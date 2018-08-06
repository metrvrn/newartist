<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
 

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$this->title = 'Администратор продаж интернет магазина';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-xs-12 text-center">
		<h1><?=Html::encode($this->title) ?></h1>
		  	<p><?=Html::a(
				'Заказы сайта',
				Html::encode(Url::to(['saleadmin/orders', ])),
				['class' => 'button-default btn']) 
			?></p>
			<p><?=Html::a(
				'Работа с ценами',
				Html::encode(Url::to(['saleadmin/price', ])),
				['class' => 'button-default btn'])
			?></p>
	</div>
	
</div>