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
	    
	   <?echo $model->newOrderId;  ?>
	   
	  <?
		foreach($model->basketArray as $item){
			
			
			echo $item['name'].' id ='.$item['id'].'<br>';
			echo $item['image'].' id ='.$item['id'].'<br>';
			
			
		}
			
			
			
	  
	  ?>
	   
	   
	</div>
    <div id="links" class="col-xs-12 col-md-9">
       
    </div>
</div>
</div>
