<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
 

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$this->title = 'работа с ценами интернет магазина';

$this->params['breadcrumbs'][] = ['label' => 'администратор интернет магазина', 'url' => [Url::to(['saleadmin/index',])]];


$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-xs-12"><h1><?= Html::encode($this->title) ?></h1></div>
    
	</div>
	
</div>