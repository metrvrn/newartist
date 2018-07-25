<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');

$this->title = 'данные заказа';
?>

<div class="row">
	<div class="col-xs-12 col-md-3">
		<?//=CatalogMenu::widget(['model' => $catalogModel])?>
  </div>
	<div class="col-xs-12 col-md-9">

	   <?echo $this->title;  ?>
	   <br>
	    
	   <?echo $model->newOrderId;  ?>
	   
	   <br>
	   <?echo $model->name;?>
	   <br>
	     <?echo $model->email;?>
	   <br>
	     <?echo $model->phone;?>
	   <br>
	      <?echo $model->adress;?>
	   <br>   <?echo $model->comment;?>
	   <br>
	   <?echo "Model id: ". $model->orderId;  ?>
	   
	   <br>
	   
	   
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
